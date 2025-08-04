<?php

namespace Ls\ClientAssistant\Controllers\PWA;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Core\Enums\AnswerStatus;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Services\ObjectCache;
use Ls\ClientAssistant\Utilities\Modules\Enrollment;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\QC;
use Ls\ClientAssistant\Utilities\Modules\V3\Enrollment as V3Enrollment;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;
use Ls\ClientAssistant\Utilities\Modules\V3\Quiz;
use Ls\ClientAssistant\Utilities\Tools\Enums\MediaConversionEnum;

class AjaxController
{
    public function item(Request $request)
    {
        $userToken = $request->cookies->get('token');
        [$item_id, $product_id, $chapter_id, $log_type] = [$_GET['iid'] ?? null, $_GET['pid'] ?? null, $_GET['chid'] ?? null, $_GET['log_type'] ?? null];

        // $start = microtime(true);
        $key = __FILE__.__LINE__.$chapter_id;
        if(ObjectCache::exists($key) and !in_array($product_id,[103])){
            $chapter = ObjectCache::get($key);
        }else{
            $chapter = LMSProduct::chapter((int) $product_id, (int) $chapter_id, ['attachments'])['data'];
            if(!empty($chapter)){
                 ObjectCache::write($key, $chapter);
            }
        }
        
        if(empty($chapter)){
            if(is_logged_in()){
            echo "<p style='padding:5px 10px'>شما به این دوره دسترسی ندارید و باید آنرا تهیه کنید<br>
                <a class='btn sm primary' style='margin 20px auto;display:block;padding:5px 20px' href='/pwa/courses'>لیست دوره ها</a>
            </p>";
            }else{
            echo "<p style='padding:5px 10px'>فقط خریداران دوره می توانند با ورود به سایت این محتوا را ببینند.<br>
                <a class='btn sm primary' style='margin 20px auto;display:block;padding:5px 20px' href='/pwa/auth'>ورود به سایت</a>
            </p>";
            }
            exit();
        }

        if (!$chapter) {
            abort(404, 'سرفصل مورد نظر شما پیدا نشد');
        }
        $items = collect($chapter['items']);
        if (!$items->contains('id', $item_id)) {
            abort(404, 'جلسه مورد نظر شما پیدا نشد');
        }
        $item = $items->keyBy('id')[$item_id];
        $slen = strlen($item['main_video']['stream_id'] ?? '');
        $data = [
            'player_type' => ($slen > 16) ? 'arvan' : (($slen > 8 ) ? 'kavimo' : 'mp4'),
            'log_type' => $log_type
        ];

        if($item['main_video']['stream_id']??false){
            $key = __LINE__."arvid".$item['main_video']['stream_id'];
            $arvanConfig = obc_get($key);
            if(!$arvanConfig)
                $arvanConfig = obc_write($key,$this->getArvanConfig($item['main_video']['stream_id']));
        }

        $data['arvanUrl'] = ($data['player_type'] == 'arvan') ? $arvanConfig['data']['config_url'] : null;

        return WebResponse::view('sdk.pwa.course-screen.partials.player', compact('item', 'chapter','data'));

    }

    public function myCoursesStats(Request $request){
        $user = current_user();
        if (!$user)
            return JsonResponse::forbidden('Invalid Request');
        $enrollments = V3Enrollment::list(
            ModuleFilter::new()
                ->search('entity_type', 'lms_products')
                ->search('user_id', $user['id'])
                ->includes('entity')
                ->perPage(500)
                ->orderBy('last_log_date')->sortedBy('DESC')
        )->get('data');
        if ($user['id'] != $enrollments[0]['user_id'])
            return JsonResponse::forbidden('Invalid Request');

        $data['counts'] = count($enrollments);
        foreach($enrollments as $e){
            $data['prodcuts'][$e['entity']['id']]['id'] = $e['entity']['id'];
            $data['prodcuts'][$e['entity']['id']]['title'] = $e['entity']['title'];
            $data['prodcuts'][$e['entity']['id']]['price'] = $e['entity']['price']['main'];
            $data['prodcuts'][$e['entity']['id']]['is_on_sale'] = $e['entity']['is_on_sale'];
            $data['prodcuts'][$e['entity']['id']]['banner'] = get_media_url($e['entity']['banner'], '', MediaConversionEnum::MEDIUM_THUMBNAIL);
            $data['progress_percents'][$e['id']] = $e['progress_percent'];
            $data['last_log_dates'][$e['id']] = to_persian_date($e['last_log_date'],'%d %B %y');
        }
        return JsonResponse::success('success', $data);
    }

    public function appLog(Request $request){
        $key = "applog-1h";
        if(!empty($_COOKIE[$key] ?? '')){
            echo "hold";
            return;
        }
        API::post('client/v3/user/user-last-activity-log');
        setcookie($key,date('Y-m-d H:i:s'), time() + 36000, '/');
        echo "sent";
        return;
    }

    public function enrollmentLogs(Request $request,string $enrollment_id)
    {
        $user = current_user();
        $enrollment = V3Enrollment::get($enrollment_id,
            ModuleFilter::new()
                ->includes('enrollmentLogs')
                ->excludes('entity')
        )->get('data');
        if(!is_numeric($enrollment_id) || $enrollment['user_id'] != $user['id'] )
            return JsonResponse::forbidden('Invalid Request');

        $data['progress_percent'] = $enrollment['progress_percent'];
        $data['statuses'] = [];
        foreach($enrollment['enrollmentLogs'] as $log){
            $status = !is_null($log['completed_at']) ? 'completed' :
                (!is_null($log['last_played_at']) ? 'played':
                    (!is_null($log['last_visited_at']) ? 'visited': '')
                );
            $data['statuses'][$log['product_item_id']] = $status;
        }
        return JsonResponse::success('success', $data);
    }



    public function itemSignal(Request $request)
    {
        if (! in_array($request->type, ['completed', 'visited'])) {
            return 'خطا: سیگنال نامعتبر';
        }
        $enrollment = Enrollment::findByUserAndProductItem($request->itemId, $request->cookies->get('token'))['data']['enrollment'];
        Enrollment::signal($enrollment['id'], $request->itemId, $request->type, $request->cookies->get('token'));
        return 'ثبت شد!';
    }


    function getArvanConfig($stream_id)
    {
        $apiKey = setting('_env_video_streaming_api_key');
        $url = "https://napi.arvancloud.ir/vod/2.0/videos/$stream_id";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $headers = [
            'Content-Type: application/json',
            'Authorization: ' . $apiKey,
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($response === false) {
            return false;
        } else {
            return json_decode($response,true);
        }
        curl_close($ch);
    }

    public function itemReaction(Request $request)
    {
        $productId = $request->request->get('product_id');
        $itemId = $request->request->get('item_id');
        $rate = $request->request->get('rate');
        $comment = $request->request->get('comment');

        QC::addReview([
            'product_id' => $productId,
            'item_id' => $itemId,
            'rate' => $rate,
            'comment' => $comment
        ], $request->cookies->get('token'));

        return JsonResponse::success('ذخیره شد');
    }

    public function quizAnswer(int $quizId, int $questionId, Request $request)
    {
        if (empty($request->answer)) {
            return JsonResponse::unprocessableEntity('پاسخی ارسال نشد.');
        }

        $response = Quiz::storeAnswer(
            ModuleFilter::new()
                ->otherParams('quiz_id', $quizId)
                ->otherParams('question_id', $questionId)
                ->otherParams('answer', $request->answer)
        );
        if (! $response->get('success')) {
            return JsonResponse::json($response->get('message') , $response->get('status_code'));
        }

        $answer = $response->get('data');
        $answerStatus = [
            'correct' => $answer['status']['value'] === AnswerStatus::Correct,
            'incorrect' => $answer['status']['value'] === AnswerStatus::Incorrect,
            'pending' => !in_array($answer['status']['value'], [AnswerStatus::Correct, AnswerStatus::Incorrect]),
        ];

        return JsonResponse::success('پاسخ شما با موفقیت ثبت شد.', $answerStatus);
    }

    public function updatePassword(Request $request)
    {
        $data = $request->request->all();

        if (empty($data['password']) or empty($data['password_confirmation'])) {
            return JsonResponse::unprocessableEntity('لطفا تمامی مقادیر را پر کنید');
        }

        $updatedPassword = \Ls\ClientAssistant\Utilities\Modules\User::updatePassword('', $data['password'], $data['password_confirmation'], $request->cookies->get('token'));

        return JsonResponse::json($updatedPassword->get('message'), ($updatedPassword->get('success') ? 200 : 405));
    }
}
