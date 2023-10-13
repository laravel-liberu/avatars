<?php

namespace LaravelLiberu\Avatars\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelLiberu\Avatars\Http\Requests\ValidateAvatar;

class Store extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidateAvatar $request)
    {
        $avatar = $request->user()->avatar;

        $this->authorize('update', $avatar);

        $avatar->store($request->file('avatar'));
    }
}
