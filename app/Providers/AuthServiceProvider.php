<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\User;
use App\Models\Event;
use App\Models\Score;
use App\Policies\TeamPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        //

        Gate::define('editEvent', function (User $user, Event $event) {
            return $user->id === $event->user_id;
        });

        Gate::define('editScore', function (User $user, Score $score) {
            return $user->id === $score->user_id;
        });
    }
}
