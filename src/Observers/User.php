<?php

namespace LaravelLiberu\Avatars\Observers;

use LaravelLiberu\Users\Models\User as Model;

class User
{
    public function created(Model $user)
    {
        $user->generateAvatar();
    }
}
