<?php

namespace LaravelLiberu\Avatars\Dynamics\Methods;

use Closure;
use LaravelLiberu\Avatars\Models\Avatar;
use LaravelLiberu\Avatars\Services\DefaultAvatar;
use LaravelLiberu\DynamicMethods\Contracts\Method;

class GenerateAvatar implements Method
{
    public function name(): string
    {
        return 'generateAvatar';
    }

    public function closure(): Closure
    {
        return fn (): Avatar => (new DefaultAvatar($this))->create();
    }
}
