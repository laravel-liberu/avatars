<?php

namespace LaravelLiberu\Avatars;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use LaravelLiberu\Avatars\Commands\GenerateAvatars;
use LaravelLiberu\Avatars\Dynamics\Methods\GenerateAvatar;
use LaravelLiberu\Avatars\Dynamics\Relations\Avatar as Relation;
use LaravelLiberu\Avatars\Observers\User as Observer;
use LaravelLiberu\DynamicMethods\Services\Methods;
use LaravelLiberu\Users\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->load()
            ->relations()
            ->publish()
            ->commands(GenerateAvatars::class);
    }

    private function load()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../routes/api.php');

        return $this;
    }

    private function relations()
    {
        Methods::bind(User::class, [Relation::class, GenerateAvatar::class]);

        App::make(User::class)::observe(Observer::class);

        return $this;
    }

    private function publish()
    {
        $this->publishes([
            __DIR__.'/../storage/app' => storage_path('app'),
        ], 'avatars-storage');

        return $this;
    }
}
