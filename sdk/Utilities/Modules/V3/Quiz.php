<?php

namespace Ls\ClientAssistant\Utilities\Modules\V3;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Quiz extends Cacher
{
    public static function find(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/core/quiz/show', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getQuestionById(int $id, ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/core/question/'.$id, $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function storeAnswer(int $quizId, int $questionId, mixed $answer): Collection
    {
        try {
            return API::post('client/v3/core/answer', [
                'quiz_id' => $quizId, 'question_id' => $questionId, 'answer' => $answer
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function storeAnswersheet(int $quizId): Collection
    {
        try {
            return API::post('client/v3/core/answersheet', [
                'quiz_id' => $quizId
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function listAnswer(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/core/answer', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function signalAnswer(int $answerId, array $data): Collection
    {
        try {
            return API::patch('client/v3/core/answer/'.$answerId, $data);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function listAnswersheet(ModuleFilter $filter = null): Collection
    {
        try {
            return API::get('client/v3/core/answersheet', $filter ? $filter->all() : []);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }
}
