<?php

namespace LaravelLiberu\Avatars\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\Avatars\Models\Avatar;

class Show extends Controller
{
    public function __invoke(Avatar $avatar)
    {
        return $avatar->url
            ? redirect($avatar->url)
            : $avatar->file->inline();
    }
}
