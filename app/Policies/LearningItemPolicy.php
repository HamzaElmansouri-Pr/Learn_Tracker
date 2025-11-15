<?php

namespace App\Policies;

use App\Models\LearningItem;
use App\Models\User;

class LearningItemPolicy
{
    public function view(User $user, LearningItem $learningItem)
    {
        return $user->id === $learningItem->user_id;
    }

    public function update(User $user, LearningItem $learningItem)
    {
        return $user->id === $learningItem->user_id;
    }

    public function delete(User $user, LearningItem $learningItem)
    {
        return $user->id === $learningItem->user_id;
    }
}

