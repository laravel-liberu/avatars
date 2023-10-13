<?php

namespace LaravelLiberu\Avatars\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\UploadedFile;
use LaravelLiberu\Files\Contracts\Attachable;
use LaravelLiberu\Files\Contracts\Extensions;
use LaravelLiberu\Files\Contracts\MimeTypes;
use LaravelLiberu\Files\Contracts\OptimizesImages;
use LaravelLiberu\Files\Contracts\ResizesImages;
use LaravelLiberu\Files\Models\File;
use LaravelLiberu\Users\Models\User;

class Avatar extends Model implements Attachable, Extensions, MimeTypes, ResizesImages, OptimizesImages
{
    protected $guarded = [];

    protected $hidden = ['user_id', 'created_at', 'updated_at'];

    protected $casts = ['user_id' => 'integer'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function file(): Relation
    {
        return $this->belongsTo(File::class);
    }

    public function store(UploadedFile $uploadedFile): self
    {
        $oldFile = $this->file;

        $file = File::upload($this, $uploadedFile);

        $this->fill(['url' => null])
            ->file()->associate($file)->save();

        $oldFile?->delete();

        return $this;
    }

    public function extensions(): array
    {
        return ['jpg', 'jpeg', 'png', 'gif'];
    }

    public function mimeTypes(): array
    {
        return ['image/png', 'image/jpg', 'image/jpeg', 'image/gif'];
    }

    public function imageWidth(): int
    {
        return 250;
    }

    public function imageHeight(): int
    {
        return 250;
    }
}
