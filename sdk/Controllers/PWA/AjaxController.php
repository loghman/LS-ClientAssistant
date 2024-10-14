<?php

namespace Ls\ClientAssistant\Controllers\PWA;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Services\ObjectCache;
use Ls\ClientAssistant\Utilities\Modules\Enrollment;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\User;
use Ls\ClientAssistant\Utilities\Modules\V3\Enrollment as V3Enrollment;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;
use Ls\ClientAssistant\Utilities\Tools\Enums\MediaConversionEnum;

class AjaxController
{
    public function item(Request $request)
    {
        $userToken = $request->cookies->get('token');
        [$item_id, $product_id, $chapter_id, $log_type] = [$_GET['iid'] ?? null, $_GET['pid'] ?? null, $_GET['chid'] ?? null, $_GET['log_type'] ?? null];

        // $start = microtime(true);
        $key = __FILE__.__LINE__.$chapter_id;
        if(ObjectCache::exists($key)){
            $chapter = ObjectCache::get($key);
        }else{
            $chapter = ObjectCache::write($key, LMSProduct::chapter((int) $product_id, (int) $chapter_id, ['attachments'])['data']);
        }
        // echo (microtime(true) - $start) . 'ms';


        if (!$chapter) {
            abort(404, 'سرفصل مورد نظر شما پیدا نشد');
        }
        $items = collect($chapter['items']);
        if (!$items->contains('id', $item_id)) {
            abort(404, 'جلسه مورد نظر شما پیدا نشد');
        }
        $item = $items->keyBy('id')[$item_id];
        $slen = strlen($item['main_video']['stream_id']);
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
                ->otherFilters('type', 'lms')
                ->search('entity_type', 'lms_products')
                ->search('user_id', $user['id'])
                ->includes('entity')
                ->perPage(500)
                ->orderBy('last_log_date')->sortedBy('DESC')
        )->get('result');
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

    public function enrollmentLogs(Request $request,string $enrollment_id)
    {
        $user = current_user();
        $enrollment = V3Enrollment::get($enrollment_id,
        ModuleFilter::new()
            ->includes('enrollmentLogs')
            ->excludes('entity')
        )->get('result');
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
}
