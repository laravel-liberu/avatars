<?php

namespace LaravelLiberu\Avatars;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use LaravelLiberu\Avatars\Models\Avatar;
use LaravelLiberu\Avatars\Policies\AvatarPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Avatar::class => AvatarPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
