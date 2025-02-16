<?php

namespace Ls\ClientAssistant\Controllers;

use Illuminate\Http\Request;
use Ls\ClientAssistant\Core\Router\JsonResponse;
use Ls\ClientAssistant\Core\Router\WebResponse;
use Ls\ClientAssistant\Helpers\Config;
use Ls\ClientAssistant\Services\ObjectCache;
use Ls\ClientAssistant\Utilities\Modules\TaskManager;
use Ls\ClientAssistant\Utilities\Modules\V3\LMSProduct;
use Ls\ClientAssistant\Utilities\Modules\V3\ModuleFilter;
use Symfony\Component\HttpFoundation\JsonResponse as SymfonyJsonResponse;

class WorkflowFormController
{
    public function prepareForm($workflow, Request $request)
    {
        $key = __FILE__.__LINE__.$workflow;
        if(ObjectCache::exists($key)){
            $response = ObjectCache::get($key);
        }else{
            $response = ObjectCache::write($key, TaskManager::formData($workflow));
        }

        if (!$response->get('success')) {
            abort(404);
        }

        $workflowData = $response->get('data');

        $courses = [];
        if (!$request->has('ei')) {
            $response = LMSProduct::cacheActive()->keyValList(
                'title',
                ModuleFilter::new()
                    ->orderBy('id')
                    ->sortedBy('asc')
                    ->perPage(Config::get('workflow_form.max_course_count_for_select'))
            );
            if ($response->get('success')) {
                $courses = $response->get('data')['data'];
            }
        }

        $view = ($request->has('m') ? 'sdk.workflow.index-m' : 'sdk.workflow.index');
        return WebResponse::view(
            $view,
            [
                'title' => $request->get('title'),
                'entityType' => $request->get('et'),
                'entityId' => $request->get('ei'),
                'source' => $request->get('source'),
                'workflowData' => $workflowData,
                'courses' => $courses,
                'showWelcomeMessage' => true,
                'timeToCallOptions' => [
                    '10-13' => '۱۰ تا ۱۳'
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
            return new SymfonyJsonResponse($response->toArray(), $response->get('status_code'));
        }

        if (mb_substr($firstName, -1) === 'ا') // نادیا عزیز => نادیای عزیز
            $firstName .= 'ی';

        $nextFollowupDate = $response->get('data')['next_followup_date'] ?? null;
        $message = sprintf("ممنون %s عزیز<br>درخواست شما ثبت شد.<br>به زودی با شما تماس خواهیم گرفت", $firstName);

        return JsonResponse::success('', compact('message'));
    }
}
