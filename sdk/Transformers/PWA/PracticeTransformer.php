<?php

namespace Ls\ClientAssistant\Transformers\PWA;

use Ls\ClientAssistant\Transformers\BaseTransformer;
use Ls\ClientAssistant\Utilities\Tools\Enums\MediaCollectionEnum;
use Ls\ClientFramework\Objects\User;

class PracticeTransformer extends BaseTransformer
{
    public function __construct(array|object $resource, private ?array $prevItem, private ?array $nextItem)
    {
        parent::__construct($resource);
    }

    public function transform(): array
    {
        $creator = (array) $this->creator;
        return [
            'id' => $this->id,
            'entity' => $this->productItem($this->productItem),
            'questions' => $this->questions($this->questions),
            'questions_count' => count($this->questions),
            'questions_point' => array_sum(array_column($this->questions, 'max_point')),
            'creator' => ! empty($creator) ? User::new($creator)->values('full_name', 'avatar_medium_url') : [],
            'signal_url' => route('panel.course.signal', ['item_id' => $this->productItem['id']]),
            'next' => $this->navigateItem($this->nextItem),
            'prev' => $this->navigateItem($this->prevItem),
        ];
    }

    private function questions(array $questions): array
    {
        $quests = [];
        foreach ($questions as $index => $question) {
            $quests[] = [
                'id' => $question['id'],
                'label' => 'سوال '.number_to_letter_persian(++$index),
                'question' => $question['question']['full'],
                'answer_description' => $question['answer_description'],
                'media' => $this->media($question['media']),
                'answer' => $this->answer($question['currentUserAnswer']),
                'is_survey' => $question['is_survey'],
                'point' => $question['max_point'],
                'type' => $question['type']['value'],
                'max_file_size' => $question['payload']['max_file_size'] ?? null,
                'allowed_file_formats' => $question['payload']['allowed_file_formats'] ?? null,
                'answer_count' => $question['answer_count'] > 0 ? $question['answer_count'] - 1 : 0,
                'created_at' => $question['created_at']['jalali']['main'],
                'show_another_answer_url' => route('panel.quiz.answer.list', ['quiz_id' => $this->id, 'question_id' => $question['id'], 'page' => 1]),
                'answer_url' => route('pwa.simple.practice.store', ['quiz_id' => $this->id, 'question_id' => $question['id']])
            ];
        }

        return $quests;
    }

    private function media(?array $medias): array
    {
        $array = [];

        foreach ($medias ?? [] as $media) {
            if (in_array($media['collection_name'], [MediaCollectionEnum::ATTACHMENT, MediaCollectionEnum::ATTACHMENTS, MediaCollectionEnum::DOCUMENT])) {
                $array[] = [
                    'url' => $media['url'],
                    'size' => $media['size']
                ];
            }
        }
        return $array;
    }

    private function answer(?array $answer): ?array
    {
        if (empty($answer)) {
            return null;
        }

        $status = $answer['status']['value'];
        return [
            'displayable' => $answer['show_answer'],
            'is_pending' => $status === 'pending',
            'status_label' => $status !== 'pending' ? 'تصحیح شده' : '',
            'point' => $answer['point'],
            'answer' => $answer['answer'][0] ?? '',
            'created_at' => $answer['created_at']['jalali']['main'],
            'user' => ! empty($answer['user']) ? User::new($answer['user'])->values('full_name', 'avatar_medium_url') : [],
        ];
    }

    private function productItem(array $productItem): array
    {
        return [
            'id' => $productItem['id'],
            'title' => $productItem['title'],
        ];
    }

    private function navigateItem(?array $item): ?array
    {
        if (! $item) {
            return null;
        }
        $isLocked = $item['locked'];

        return [
            'id' => $item['id'],
            'title' => $item['title'],
            'is_locked' => $isLocked,
            'url' => $this->getUrl($item, $isLocked),
        ];
    }

    private function getUrl(array $item, bool $isLocked): string
    {
        if ($isLocked) {
            return '#';
        }

        return match ($item['type']['name']) {
            'Quiz' => route('panel.course.quiz', ['item_id' => $item['id']]),
            'Kata' => route('panel.course.practice', ['item_id' => $item['id']]),
            default => route('panel.course.video', ['item_id' => $item['id']])
        };
    }
} 