<?php

namespace Ls\ClientAssistant\Controllers\PWA;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Transformers\PWA\VideoTransformer;
use Ls\ClientAssistant\Transformers\PWA\PracticeTransformer;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProductItem;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;
use Ls\ClientAssistant\Utilities\Modules\V3\Quiz;
use Ls\ClientFramework\Transformers\Panel\ProductItemPracticeTransformer;

class PwaSimpleController
{
    public function video_screen(Request $request, string $item_id)
    {
        $user = current_user();
        $data = self::shered_data();
        $response = LMSProductItem::get(
            $item_id,
            ModuleFilter::new()
                ->includes('product.currentUserEnrollment', 'parent', 'media', 'currentUserEnrollmentLog', 'questions.currentUserAnswer')
        );
        // TODO : Check Enrollment ...
        if ($response['status_code'] == 403){
            $message = "شما به این دوره دسترسی ندارید...";
            return WebResponse::view('sdk.pwa.pages.403',compact('data','message'));
        }

        if ($response->get('data')['type']['name'] === "Kata"){
            redirect(route('pwa.simple.practice.screen',['item_id' => $item_id]));
        }

        $item = VideoTransformer::item($response);
        $item->type = (object)$response['data']['type'];
        $pagetitle = $item->title;
        return WebResponse::view('sdk.pwa.simple.video.screen', compact('pagetitle', 'data', 'item'));
    }

    public function quiz_start(Request $request, string $item_id)
    {
        $user = current_user();
        $data = self::shered_data();
        $quiz = '';
        $pagetitle = "item-title-here";
        return WebResponse::view('sdk.pwa.simple.quiz.start', compact('pagetitle','data','quiz'));
    }
    public function quiz_screen(Request $request, string $item_id)
    {
        $user = current_user();
        $data = self::shered_data();
        $quiz = '';
        $pagetitle = "item-title-here";
        return WebResponse::view('sdk.pwa.simple.quiz.screen', compact('pagetitle','data','quiz'));
    }
    public function quiz_result(Request $request, string $item_id)
    {
        $user = current_user();
        $data = self::shered_data();
        $quiz = '';
        $pagetitle = "item-title-here";
        return WebResponse::view('sdk.pwa.simple.quiz.result', compact('pagetitle','data','quiz'));
    }

    private static function shered_data()
    {
        return [
            'brand_name'            => setting('brand_name_fa'),
            'logo_url'              => setting('logo_icon_url') ?? setting('logo_url') ?? '',
            'logotype_url'          => setting('logo_url') ?? setting('logo_icon_url') ?? '',
        ];
    }

    public function practice_screen(Request $request, string $itemId)
    {
        $data = self::shered_data();

        $response = Quiz::find(
            $itemId,
            ModuleFilter::new()
                ->includes('productItem', 'questions.media', 'questions.currentUserAnswer.user', 'currentUserAnswersheet', 'creator','productItem.product.currentUserEnrollment'),
            'product_item_id'
        );

        if (! $response->get('success'))
        {
            dd($response->get('status_code'));
            abort($response->get('status_code'), $response->get('message'));
        }

        $resp = LMSProductItem::navigate(
            $itemId,
            ModuleFilter::new()
                ->otherParams('keys', ['next', 'prev'])
        );

        $prev = $next = null;
        if ($resp->get('success')) {
            $prev = $resp->get('data')['prev'];
            $next = $resp->get('data')['next'];
        }

        $item = PracticeTransformer::item($response, $prev, $next);

        return WebResponse::view('sdk.pwa.simple.practice.screen', compact('item','data'));
    }

    public function practice_store(int $quizId, int $questionId, Request $request)
    {
        if (empty($request->answer) && empty($request->attachment)) {
            return JsonResponse::unprocessableEntity('پاسخی ارسال نشد.');
        }

        // Handle different answer types
        $answerData = $request->answer;

        $response = Quiz::storeAnswer(
            ModuleFilter::new()
                ->otherParams('quiz_id', $quizId)
                ->otherParams('question_id', $questionId)
                ->otherParams('answer', $answerData)
        );

        if (! $response->get('success')) {
            return JsonResponse::json($response->get('message'), $response->get('status_code'));
        }

        return JsonResponse::success('پاسخ شما با موفقیت ثبت شد.');
    }
}