<?php

namespace App\UseCases\Master\JobCategory;

use App\Models\JobCategory;
use Illuminate\Support\Facades\Storage;

class CreateAction
{
    /**
     * Undocumented function
     *
     * @param string $name
     * @param string $content
     * @param string $image
     * @param integer $sort_no
     * @return array
     */
    public function __invoke(string $name, string $content, string $image, int $sort_no): array
    {
        $create = [
            'name' => $name,
            'content' => $content,
            'image' => $image,
            'sort_no' => $sort_no,
        ];
        $item = JobCategory::create($create)->toArray();
        // ファイルのurlをセット
        if (!empty($item) && array_key_exists('image', $item)) {
            $item['image_url'] = config('filesystems.base_url') . Storage::url($item['image']);
        }
        return $item;
    }
}
