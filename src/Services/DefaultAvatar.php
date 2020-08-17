<?php

namespace LaravelEnso\Avatars\Services;

use Exception;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use LaravelEnso\Avatars\Services\Generators\Laravolt;
use LaravelEnso\Avatars\Services\Generators\Gravatar;
use LaravelEnso\Core\Models\User;

class DefaultAvatar
{
    private const Filename = 'avatar';
    private const Extension = 'jpg';

    private $user;
    private $avatar;
    private File $file;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function create()
    {
        DB::transaction(fn () => $this->findOrCreate()
            ->generate()
            ->attach());

        return $this->avatar;
    }

    private function findOrCreate(): self
    {
        $this->avatar = $this->user->avatar()
            ->firstOrCreate(['user_id' => $this->user->id]);

        return $this;
    }

    private function generate(): self
    {
        try {
            $this->file = (new Gravatar($this->avatar))
                ->generate();
        } catch (Exception $e) {
            $this->file = (new Laravolt($this->avatar))
                ->generate();
        }

        return $this;
    }

    private function attach(): void
    {
        $this->avatar->attach($this->file, $this->originalName());
    }

    private function originalName(): string
    {
        return self::Filename.$this->user->id.'.'.self::Extension;
    }
}
