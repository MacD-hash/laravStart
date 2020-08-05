<?php

namespace App\Providers;

use App\Post;
use App\Policies\PostPolicy;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    // protected $policies = [
    //     'App\Model' => 'App\Policies\ModelPolicy',
    // ];
    protected $policies = [
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function($user){
            return $user->type == 'admin';
        });

        Gate::define('isAuthor', function($user){
            return $user->type == 'author';
        });

        Gate::define('isUser', function($user){
            return $user->type == 'user';
        });

        // Gate::define('isAdmin', function($user, $profileUser){
        //     return $user->id === $profileUser->id;
        // });

        Passport::routes();
    }
    // public function boot()
    // {
    //     $this->registerPolicies();
    //     Passport::routes();
    // }
}
