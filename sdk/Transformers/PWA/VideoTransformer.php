<?php

namespace Ls\ClientAssistant\Transformers\PWA;

use Ls\ClientAssistant\Transformers\BaseTransformer;
use Ls\ClientAssistant\Utilities\Tools\Enums\MediaCollectionEnum;

class VideoTransformer extends BaseTransformer
{
    public function transform(): array
    {
        return [
            'id' => $this->id,
            'parent_id' => $this->parent_id,
            'title' => $this->title,
            'description' => $this->description['full'] ?? null,
            'product_id' => $this->product_id,
            'videos_feedbacks_emojis' => $this->videos_feedbacks_emojis,
            'is_completed' => (bool)($this->log['completed_at'] ?? null),
            'product' => $this->product($this->product),
            'chapter' => $this->chapter($this->parent),
            'duration' => $this->videos_duration['human'] ?? null,
            'video' => $this->video($this->media),
            'next' => $this->navigateItem($this->next_item),
            'attachments' => $this->attachments($this->media),
            'chapter_url' => route('pwa.courseScreen', ['pid' => $this->product_id, 'e' => $this->parent_id]),
            'reaction_url' => route('ajax.item.reaction'),
            'questions' => $questions = $this->questions($this->questions),
            'question_seconds' => $this->questionSeconds($questions),
        ];
    }

    private function product(array $product): array
    {
        return [
            'slug' => $product['slug'],
            'title' => $product['title'],
            'enrollment' => $this->enrollment($product['log']),
        ];
    }

    private function chapter(array $chapter): array
    {
        return [
            'id' => $chapter['id'],
            'title' => $chapter['title'],
        ];
    }

    private function video(array $medias): ?array
    {
        if (empty($medias)) {
            return null;
        }

        foreach ($medias as $media) {
            if ($media['collection_name'] === MediaCollectionEnum::VIDEO) {
                return [
                    'video_url' => $media['url'] ?? null,
                    'size' => $media['size'],
                    'stream_url' => $media['stream_id'] ? "https://stream.7learn.com/{$media['stream_id']}/embed" : null,
                ];
            }
        }

        return null;
    }

    private function navigateItem(?array $nextItem): ?array
    {
        if (! $nextItem) {
            return null;
        }
        $isLocked = $nextItem['locked'];

        return [
            'id' => $nextItem['id'],
            'title' => $nextItem['title'],
            'is_locked' => $isLocked,
            'url' => $this->getUrl($nextItem, $isLocked),
        ];
    }

    private function getUrl(array $item, bool $isLocked): string
    {
        if ($isLocked) {
            return '#';
        }

        return match ($item['type']['name']) {
            'Quiz' => route('pwa.simple.quiz.start', ['item_id' => $item['id']]),
//            'Kata' => route('pwa.simple.practice.screen', ['item_id' => $item['id']]),
            default => route('pwa.simple.video', ['item_id' => $item['id']])
        };
    }

    private function attachments(array $medias): array
    {
        if (empty($medias)) {
            return [];
        }

        $attachments = [];
        foreach ($medias as $media) {
            if (in_array($media['collection_name'], [MediaCollectionEnum::ATTACHMENT, MediaCollectionEnum::ATTACHMENTS])) {
                $attachments[] = [
                    'url' => $media['url'],
                    'size' => $media['size'],
                    'title' => $media['title'],
                ];
            }
        }

        return $attachments;
    }

    private function enrollment(array $enrollment): array
    {
        return [
            'id' => $enrollment['id'],
            'progress_percent' => $enrollment['progress_percent'],
        ];
    }

    private function questions(?array $questions): array
    {
        $array = [];
        foreach ($questions as $question) {
            if ($question['current_user_answer']) {
                continue;
            }
            $array[] = [
                'id' => $question['id'],
                'quiz_id' => $question['quiz_id'],
                'second' => $question['payload']['inplay_second'] ?? '',
                'question' => $question['question'],
                'options' => $options = ($question['payload']['options'] ?? []),
                'point' => $question['max_point'],
                'multiple_choice' => array_sum(data_get($options, '*.is_correct')) > 1,
                'answer_url' => route('ajax.quiz.answer', ['quiz_id' => $question['quiz_id'], 'question_id' => $question['id']])
            ];
        }
        return $array;
    }

    private function questionSeconds(array $questions): string
    {
        $array = [];
        foreach ($questions as $question) {
            $array[$question['second']] = $question['id'];
        }

        return json_encode($array, JSON_HEX_TAG);
    }
}