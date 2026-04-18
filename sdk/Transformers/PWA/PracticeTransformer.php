<?php

namespace Ls\ClientAssistant\Transformers\PWA;

use Ls\ClientAssistant\Core\Enums\ExerciseAnswerStatus;
use Ls\ClientAssistant\Core\Enums\ProductItemType;
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
        $creator = (array) $this->productItem['creator'];
        return [
            'id' => $this->id,
            'entity' => $this->productItem($this->productItem),
            'product' => $this->product($this->productItem['product']),
            'questions' => $this->questions((array) $this->resource),
            'questions_count' => 1,
            'questions_point' => $this->max_score,
            'creator' => ! empty($creator) ? User::new($creator)->values('full_name', 'avatar_medium_url') : [],
            'next' => $this->navigateItem($this->nextItem),
            'prev' => $this->navigateItem($this->prevItem),
        ];
    }

    private function questions(array $question): array
    {
        $quests = [];
        $quests[] = [
            'id' => $question['id'],
            'label' => 'سوال '.number_to_letter_persian(1),
            'question' => $question['question']['full'],
            'answer_description' => $question['correct_answer'],
            'description' => $question['correct_answer'] ?? null,
            'media' => $this->media($this->productItem['media'] ?? []),
            'answer' => $this->answer($question['currentUserAnswer']),
            'is_survey' => false,
            'point' => $question['max_score'],
            'type' => '',
            'max_file_size' => $question['payload']['max_file_size'] ?? null,
            'allowed_file_formats' => $question['payload']['allowed_file_formats'] ?? null,
            'created_at' => $question['created_at']['jalali']['main'],
            'answer_url' => route('pwa.simple.practice.store', ['practice_id' => $this->id])
        ];
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
            'displayable' => true,
            'is_pending' => $status === ExerciseAnswerStatus::Pending,
            'status' => $status,
            'status_label' => $status !== ExerciseAnswerStatus::Pending ? 'تصحیح شده' : 'در انتظار بررسی',
            'point' => $answer['score'],
            'answer' => $answer['answer'] ?? '',
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

        return match ($item['type']['value']) {
            ProductItemType::Exercise => route('pwa.simple.practice.screen', ['item_id' => $item['id']]),
            ProductItemType::Quiz => route('pwa.simple.quiz.start', ['item_id' => $item['id']]),
            default => route('pwa.simple.video', ['item_id' => $item['id']])
        };
    }

    private function product(mixed $product)
    {
        return [
            'id' => $product['id'],
            'enrollment' => $this->enrollment($product['currentUserEnrollment']),
        ];
    }

    private function enrollment(array $enrollment): array
    {
        return [
            'id' => $enrollment['id'],
            'progress_percent' => $enrollment['progress_percent'],
        ];
    }
} 