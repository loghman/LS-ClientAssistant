<?php

namespace Ls\ClientAssistant\Controllers\PWA;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Services\ObjectCache;
use Ls\ClientAssistant\Utilities\Modules\Authentication;
use Ls\ClientAssistant\Utilities\Modules\CMS;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\User;
use Ls\ClientAssistant\Utilities\Modules\V3\BannerPosition;
use Ls\ClientAssistant\Utilities\Modules\V3\CmsPost;
use Ls\ClientAssistant\Utilities\Modules\V3\Enrollment as V3Enrollment;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProduct as V3LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PwaSimpleController
{

    public function video_screen(Request $request, string $item_id)
    {
        // get: $item->quiz->questions
        
        $user = current_user();
        $data = self::shered_data();
        $video = '';
        $pagetitle = "item-title-here";
        return WebResponse::view('sdk.pwa.simple.video.screen', compact('pagetitle','data','video'));
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
        ];
    }
}