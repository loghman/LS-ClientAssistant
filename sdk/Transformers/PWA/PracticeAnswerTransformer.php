<?php

namespace Ls\ClientAssistant\Transformers\PWA;

use Ls\ClientFramework\Core\Transformer;
use Ls\ClientFramework\Transformers\User;

class PracticeAnswerTransformer extends Transformer
{
    public function transform(): array
    {
        return [
            'id' => $this->id,
            'answer' => $this->answer[0] ?? '',
            'point' => $this->point ?? 0,
            'created_at' => $this->created_at['jalali']['main'],
            'updated_at' => $this->updated_at['jalali']['main'],
            'user' => ! empty($this->user) ? User::new($this->user)->values('full_name', 'avatar_medium_url') : [],
            'corrector' => ! empty($this->answersheet['corrector']) ? User::new($this->answersheet['corrector'])->values('full_name', 'avatar_medium_url') : [],
            'corrected_answer' => $this->answersheet['corrected_answer'] ?? null,
            'reaction_like_count' => $this->reactions['like']['count'] ?? 0,
            'reaction_dislike_count' => $this->reactions['dislike']['count'] ?? 0,
            'like_reacted' => $this->reactions['like']['user_reacted'] ?? false,
            'dislike_reacted' => $this->reactions['dislike']['user_reacted'] ?? false,
            'signal_like_url' => route('pwa.simple.practice.answer.signal', ['quiz_id' => $this->quiz_id, 'answer_id' => $this->id]) . '?type=like',
            'signal_dislike_url' => route('pwa.simple.practice.answer.signal', ['quiz_id' => $this->quiz_id, 'answer_id' => $this->id]) . '?type=dislike',
        ];
    }
} 