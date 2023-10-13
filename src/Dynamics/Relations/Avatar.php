<?php

namespace LaravelLiberu\Avatars\Dynamics\Relations;

use Closure;
use LaravelLiberu\Avatars\Models\Avatar as Model;
use LaravelLiberu\DynamicMethods\Contracts\Method;

class Avatar implements Method
{
    public function name(): string
    {
        return 'avatar';
    }

    public function closure(): Closure
    {
        return fn () => $this->hasOne(Model::class);
    }
}
