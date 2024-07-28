<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Services\ObjectCache;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;

class CoursePlayerController
{
    public function index(Request $request,string $product_id)
    {
        $user = current_user();
        if(is_null($user))
            redirect(site_url());
        $userToken = $request->cookies->get('token');

        $data = [
            'brand_name' => setting('brand_name_fa'),
            'logo_url' => setting('logo_url'),
        ];

        // $start = microtime(true);
        $key = __FILE__.__LINE__;
        if(ObjectCache::exists($key)){
            $course = ObjectCache::get($key);
        }else{
            $course = ObjectCache::write($key, LMSProduct::get($product_id)['data']);
        }

        $chapters = LMSProduct::chaptersWithUserData($product_id, $userToken)['data'];
        // $enrollment = Enrollment::findByUserAndProduct($product_id, $userToken)['data'] ?? [];
        // echo (microtime(true) - $start) . 'ms';

        return WebResponse::view('sdk.pwa.course-player.index', compact('data','course','chapters'));

    }

}





// $itemId = (int)$request->get('item');
// $chapter = LMSProduct::chapter((int)$product_id, (int)$request->get('chapter'), ['attachments'])['data'];
// if (!$chapter) {
//     abort(404, 'سرفصل مورد نظر شما پیدا نشد');
// }

// $items = collect($chapter['items']);
// if (!$items->contains('id', $itemId)) {
//     abort(404, 'جلسه مورد نظر شما پیدا نشد');
// } else {
//     $item = $items->keyBy('id')[$itemId];
// }


// $rich2 = LMSProduct::rich([
//     'next_item' => json_encode(['product_id' => $product_id, 'product_item_id' => $item['id']]),
//     'prev_item' => json_encode(['product_id' => $product_id, 'product_item_id' => $item['id']]),
//     'next_chapter' => json_encode(['product_id' => $product_id, 'product_item_id' => $item['parent_id']]),
//     'prev_chapter' => json_encode(['product_id' => $product_id, 'product_item_id' => $item['parent_id']]),
// ])['data'];

// $next_item = $rich2['next_item'];
// $prev_item = $rich2['prev_item'];
// $next_chapter = $rich2['next_chapter'];
// $prev_chapter = $rich2['prev_chapter'];

// // if (empty($enrollment)) {
// //     redirect(route('panel.course.list'));
// // }


// $chapter_stats = LMSProduct::chapterStats($product_id, $request->get('chapter'), $request->cookies->get('token'));
// $chapter_complete_percentage = 0;
// if ($chapter_stats['success']) {
//     $chapter_complete_percentage = $chapter_stats['data']['chapter_complete_percentage'] ?? 0;
// }
// $chapterLogs = Enrollment::getChapterLog($enrollment['id'], $chapter['id'], $enrollment['user_id'])['data'] ?? [];

// dd(
//     compact(
//         'product', 'chapter', 'chapter_complete_percentage',
//         'item', 'next_item', 'prev_item', 'next_chapter',
//         'prev_chapter', 'chapterLogs', 'product_id', 'currentUser', 'enrollment'
//     )
// );