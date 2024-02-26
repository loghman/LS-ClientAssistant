<?php

namespace Ls\ClientAssistant\Controllers;

use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProduct;

class MiniLandingController
{
    public function index(string $slug)
    {
        $product = LMSProduct::get($slug)['result'] ?? null;
        if (empty($product)) {
            abort(404, 'محصول پیدا نشد');
        }

        $brandNameEn = setting('brand_name_en');
        $currentUser = current_user();
        $introVideo = $product['meta']['intro_video']['url'] ?? '';
        $maxDurationHours = config('max-duration-hours-display');
        $productDuration = convert_seconds_to_hour($product['total_duration']) > $maxDurationHours['en']
            ? sprintf("بیش از %s ساعت", $maxDurationHours['fa'])
            : to_persian_num(convert_seconds_to_hour($product['total_duration'])) . '  ساعت آموزش';

        $hasCampaign = !empty($product['campaign_data']);

        return WebResponse::view(
            'sdk.mini-landing.index',
            compact('product', 'brandNameEn', 'currentUser', 'introVideo', 'productDuration', 'hasCampaign')
        );
    }
}