<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Utilities\Modules\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\TaskManager;

class WorkflowFormController
{
    public function prepareForm($workflow, Request $request)
    {
        $response = TaskManager::formData($workflow);
        if (!$response->get('success')) {
            abort(404);
        }

        $courses = [];
        if (!$request->has('et') && !$request->has('ei')) {
            $courses = LMSProduct::search(
                '',
                ['id', 'title', 'slug'],
                [],
                Config::get('workflow_form.max_course_count_for_select')
            );
            if (!$courses->get('success')) {
                $courses = [];
            }
            $courses = collect($courses->get('data')['data'])->pluck('title', 'id')->toArray();
        }

        return WebResponse::view(
            'sdk.workflow.index',
            [
                'title' => $request->get('title'),
                'entityType' => $request->get('et'),
                'entityId' => $request->get('ei'),
                'source' => $request->get('source'),
                'workflowData' => $response->get('data'),
                'courses' => $courses,
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
        $name = $request->get('full_name');
        $firstName = explode(' ', $name)[0];

        $response = TaskManager::store($request->get('workflow'), [
            'entity_type' => $request->get('entity_type'),
            'entity_id' => $request->get('entity_id'),
            'full_name' => $name,
            'mobile' => $request->get('mobile'),
            'email' => $request->get('email'),
            'variable_values' => $request->get('var'),
            'time2call' => $request->get('time2call'),
            'source' => $request->get('source'),
        ]);

        if (!$response->get('success')) {
            return JsonResponse::unprocessableEntity($response->get('message') ?? 'مشکلی رخ داده است.');
        }

        return JsonResponse::success(
            '',
            ['message' => sprintf('با تشکر %s عزیز درخواست شما ثبت شد. <br /> همکاران ما با شما تماس خواهند گرفت.',  $firstName)]
        );
    }
}