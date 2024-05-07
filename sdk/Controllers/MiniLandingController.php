<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Modules\V3\Gateway;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;

class MiniLandingController
{
    public function index(string $slug)
    {
        $filter = ModuleFilter::new()
            ->includes('productGifts', 'mainTeacherFaculty', 'chapters.log', 'chapters.publishedItems.log');
        $product = LMSProduct::get($slug, $filter)['result'] ?? null;
        if (empty($product)) {
            abort(404, 'محصول پیدا نشد');
        }
        $brandNameEn = setting('brand_name_en');
        $currentUser = current_user();
        $introVideo = $product['meta']['intro_video']['url'] ?? ($product['meta']['demo_video_urls'][0] ?? '');

        $productDuration=0;
        if ($product['meta']['attachment_duration_sum']['hours']>0){
            $hours = $product['meta']['attachment_duration_sum']['hours'];
            $maxDurationHours = Config::get('lms.max_duration_hours_display');
            $productDuration =  $hours > $maxDurationHours['en']
                ? sprintf("بیش از %s ساعت", $maxDurationHours['fa'])
                : to_persian_num($hours);
        }

        return WebResponse::view(
            'sdk.pages.mini-landing',
            compact(
                'product',
                'brandNameEn',
                'currentUser',
                'introVideo',
                'productDuration',
            )
        );
    }

    public function payDetails(string $slug)
    {
        $product = LMSProduct::get($slug)['result'] ?? null;
        if (empty($product)) {
            abort(404, 'محصول پیدا نشد');
        }
        $gateways = Gateway::list();
        $eligibleResponse = [];
        if (Gateway::existsSnapPay($gateways->get('data'))) {
            $eligibleResponse = Gateway::snapPayEligible($product['price']['main'])->get('data');
        }

        $view = WebResponse::renderView(
            'sdk.pages.landing-partials.pay',
            compact('gateways', 'eligibleResponse', 'product')
        );

        return JsonResponse::success('', ['html' => $view]);
    }
}