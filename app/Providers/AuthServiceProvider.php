<?php

namespace App\Providers;

use App\Models\LearningItem;
use App\Models\ExamModule;
use App\Models\LearningSession;
use App\Policies\LearningItemPolicy;
use App\Policies\ExamModulePolicy;
use App\Policies\LearningSessionPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        LearningItem::class => LearningItemPolicy::class,
        ExamModule::class => ExamModulePolicy::class,
        LearningSession::class => LearningSessionPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}

