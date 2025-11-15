<?php

namespace App\Policies;

use App\Models\ExamModule;
use App\Models\User;

class ExamModulePolicy
{
    public function view(User $user, ExamModule $examModule)
    {
        return $user->id === $examModule->user_id;
    }

    public function update(User $user, ExamModule $examModule)
    {
        return $user->id === $examModule->user_id;
    }

    public function delete(User $user, ExamModule $examModule)
    {
        return $user->id === $examModule->user_id;
    }
}

