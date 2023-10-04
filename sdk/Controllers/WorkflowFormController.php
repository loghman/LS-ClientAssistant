<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\TaskManager;

class WorkflowFormController
{
    private const maxCount = 5000;

    public function prepareForm($workflow, Request $request)
    {
        $response = TaskManager::formData($workflow);
        if (!$response->get('success')) {
            abort(404);
        }

        $courses = LMSProduct::search('', ['id', 'title', 'slug'], [], self::maxCount);
        if (!$courses->get('success')) {
            $courses = [];
        }
        $courses = collect($courses->get('data')['data'])->pluck('title', 'id')->toArray();

        return WebResponse::view(
            'workflow.form',
            [
                // TODO: get label from workflow metadata.
                'entityIdLabel' => 'برای چه دوره‌ای مشاوره میخوای؟',
                'title' => $request->get('title'),
                'entityType' => $request->get('et'),
                'entityId' => $request->get('ei'),
                'source' => $request->get('source'),
                'workflowData' => $response->get('data'),
                'courses' => $courses,
                'backUrl' => $request->header('referer') ?? site_url(''),
                'timeToCallOptions' => [
                    '10-13' => '۱۰ تا ۱۳',
                    '13-15' => '۱۳ تا ۱۵',
                    '15-17' => '۱۵ تا ۱۷',
                ]
            ]
        );
    }

    public function store(Request $request)
    {
        $response = TaskManager::store($request->get('workflow'), [
            'entity_type' => $request->get('entity_type'),
            'entity_id' => $request->get('entity_id'),
            'full_name' => $request->get('full_name'),
            'mobile' => $request->get('mobile'),
            'email' => $request->get('email'),
            'variable_values' => $request->get('var'),
            'time2call' => $request->get('time2call'),
            'source' => $request->get('source'),
        ]);

        if (!$response->get('success')) {
            return JsonResponse::unprocessableEntity($response->get('message') ?? 'مشکلی رخ داده است.');
        }

        return JsonResponse::success('درخواست شما با موفقیت ثبت شد، به زودی با شما تماس خواهیم گرفت.');
    }
}