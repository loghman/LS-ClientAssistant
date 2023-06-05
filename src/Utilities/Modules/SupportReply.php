<?php

namespace Ls\ClientAssistant\Utilities\Modules;

use Illuminate\Support\Collection;
use Ls\ClientAssistant\Core\GuzzleClient;
use Ls\ClientAssistant\Helpers\Response;

class SupportReply
{
    public static function reply(array $data, string $userToken): Collection
    {
        try {
            return GuzzleClient::post(sprintf("v1/support/topic/%s/reply", $data['topic_id']), [
                'content' => $data['content'],
                'attachment' => $data['attachment'] ?? null,
            ], [
                'Authorization' => 'Bearer ' . $userToken,
            ]);
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
        } catch (\Exception $exception) {
            return Response::parseException($exception);
        }
    }

}