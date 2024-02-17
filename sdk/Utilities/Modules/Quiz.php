<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\API;
use Ls\ClientAssistant\Helpers\Response;

class Quiz
{
    public static function findByEntity(string $entityType, int $entityId): Collection
    {
        try {
            return API::get('client/v3/core/quiz/show', [
                'entity_type' => $entityType,
                'entity_id' => $entityId,
                'includes' => implode(',', ['questions.currentUserAnswer.user']),
                'withCount' => implode(',', ['questions.currentUserAnswer.reactions']),
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function getQuestionById(int $id, array $filters = []): Collection
    {
        try {
            return API::get('client/v3/core/question/'.$id, [
                'includes' => implode(',', ['currentUserAnswer']),
                'search' => implode(',', $filters)
            ]);
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

    public static function listAnswer(int $questionId, array $data): Collection
    {
        try {
            return API::get('client/v3/core/answer', [
                    'search' => 'question_id:'.$questionId
                ]+$data);
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
}
