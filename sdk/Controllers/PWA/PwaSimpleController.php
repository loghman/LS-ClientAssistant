<?php

namespace Ls\ClientAssistant\Controllers\PWA;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Transformers\PWA\VideoTransformer;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProductItem;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;

class PwaSimpleController
{
    public function video_screen(Request $request, string $item_id)
    {
        $response = LMSProductItem::get(
            $item_id,
            ModuleFilter::new()
                ->includes('product.currentUserEnrollment', 'parent', 'media', 'currentUserEnrollmentLog', 'questions.currentUserAnswer')
        );
        $user = current_user();
        $data = self::shered_data();
        $item = VideoTransformer::item($response);
        $item->type = (object)$response['data']['type'];
        $pagetitle = $item->title;
        return WebResponse::view('sdk.pwa.simple.video.screen', compact('pagetitle','data','item'));
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
}