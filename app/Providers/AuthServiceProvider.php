<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate defined to restric regulat users to see all tasks
        Gate::define('see-task', function($user, $task){
            return ($user->role == "regular" && $user->id == $task->user_id) || $user->role == "admin";
        });

        // Gate defined to restric regular users to delete not authorized tasks
        Gate::define('delete-task', function($user, $task){
            return ($user->role == "regular" && $user->id == $task->user_id) || $user->role == "admin";
        });

        Gate::define('change_state-task', function($user, $task){
            return ($user->role == "regular" && $user->id == $task->user_id) || $user->role == "admin";
        });
    }
}
