<?php

namespace App\Providers;

use App\Page;
use App\Policies\PagePolicy;
use App\Policies\PostPolicy;
use App\Post;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Post::class => PostPolicy::class,
        Page::class => PagePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param GateContract $gate
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
        Passport::routes();
    }
}
