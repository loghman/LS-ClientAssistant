<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class SupportReply
{
    public static function create(array $data, string $userToken): Collection
    {
        try {
            return GuzzleClient::post(sprintf("v1/support/topic/%s/reply", $data['topic_id']), [
                'content' => $data['content'],
                'attachment' => $data['attachment'] ?? null,
            ], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function update(array $data, string $userToken): Collection
    {
        try {
            return GuzzleClient::put(sprintf("v1/support/topic/%s/reply/%s", $data['topic_id'], $data['reply_id']), [
                'content' => $data['content'],
                'attachment' => $data['attachment'] ?? null,
            ], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function like(int $topicId, int $replyId, string $userToken): Collection
    {
        try {
            return GuzzleClient::post(sprintf("v1/support/topic/%s/reply/%s", $topicId, $replyId), [], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

    public static function delete(int $topicId, int $replyId, string $userToken): Collection
    {
        try {
            return GuzzleClient::delete(sprintf("v1/support/topic/%s/reply/%s", $topicId, $replyId), [], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
        } catch (ClientException $exception) {
            return Response::parseClientException($exception);
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

}