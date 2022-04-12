<?php

namespace App\UseCases\File;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UploadAction
{
    /**
     * __invoke
     *
     * @param UploadedFile $file
     * @return array
     */
    public function __invoke(UploadedFile $file): array
    {
        $storage_path = Storage::putFile('public/images', $file, 'public');
        return ['storage_path' => $storage_path, 'url' => Storage::url($storage_path)];
    }
}
