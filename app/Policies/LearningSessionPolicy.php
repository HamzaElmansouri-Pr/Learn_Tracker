<?php

namespace App\Policies;

use App\Models\LearningSession;
use App\Models\User;

class LearningSessionPolicy
{
    public function update(User $user, LearningSession $learningSession)
    {
        return $user->id === $learningSession->user_id;
    }

    public function delete(User $user, LearningSession $learningSession)
    {
        return $user->id === $learningSession->user_id;
    }
}

