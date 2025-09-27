<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\V3\Gateway;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;

class MiniLandingController
{
    public function index(string $slug)
    {
        $filter = ModuleFilter::new()
            ->includes('productGifts', 'mainTeacherFaculty', 'publishedChapters', 'publishedChapters.publishedItems');
        $response = LMSProduct::get($slug, $filter);
        if (! $response->get('success')) {
            abort(404, 'محصول پیدا نشد');
        }
        $product = $response->get('data');

        $brandNameEn = setting('brand_name_en');
        $currentUser = current_user();
        $introVideo = get_media_url($product['intro_video'], $product['meta']['demo_video_urls'][0] ?? '');
        $productDuration = 0;
        if (isset($product['attachment_duration_sum']['hours']) && $product['attachment_duration_sum']['hours'] !== 0) {
            $productDuration = product_duration_to_string_summary($product['attachment_duration_sum']['hours']);
        }

        return WebResponse::view(
            'sdk.pages.mini-landing',
            compact(
                'product',
                'brandNameEn',
                'currentUser',
                'introVideo',
                'productDuration'
            )
        );
    }

    public function payDetails(string $slug)
    {
        $response = LMSProduct::get($slug);
        if (! $response->get('success')) {
            return JsonResponse::notFound('محصول پیدا نشد.');
        }
        $product = $response->get('data');
        if (! $product['is_on_sale']) {
            return JsonResponse::notFound('ثبت نام این دوره در حال حاضر متوقف شده است.');
        }

        $gateways = Gateway::list();
        $eligibleResponse = [];
        $snapPay = Gateway::findSnapPay($gateways->get('data'));
        if (null !== $snapPay) {
            $price = $snapPay['is_discount_available'] ? $product['final_price']['main'] : $product['price']['main'];
            $eligibleResponse = Gateway::snapPayEligible($price)->get('data');
        }

        $view = WebResponse::renderView(
            'sdk.pages.landing-partials.pay',
            compact('gateways', 'eligibleResponse', 'product')
        );

        return JsonResponse::success('', ['html' => $view]);
    }

    public function quickPay(string $slug)
    {
        $filter = ModuleFilter::new()
            ->includes('productGifts', 'mainTeacherFaculty', 'publishedChapters', 'publishedChapters.publishedItems');
        $response = LMSProduct::get($slug, $filter);
        if (! $response->get('success')) {
            abort(404, 'محصول پیدا نشد');
        }
        $product = $response->get('data');

        $brandNameEn = setting('brand_name_en');
        $currentUser = current_user();
        $introVideo = get_media_url($product['intro_video'], $product['meta']['demo_video_urls'][0] ?? '');
        $productDuration = 0;
        if (isset($product['attachment_duration_sum']['hours']) && $product['attachment_duration_sum']['hours'] !== 0) {
            $productDuration = product_duration_to_string_summary($product['attachment_duration_sum']['hours']);
        }

        return WebResponse::view(
            'sdk.pages.quick-pay',
            compact(
                'product',
                'brandNameEn',
                'currentUser',
                'introVideo',
                'productDuration'
            )
        );
    }
}