<?php

namespace App\UseCases\Master\JobCategory;

use App\Models\JobCategory;
use Illuminate\Support\Facades\Storage;

class ListAction
{
    /**
     * __invoke
     *
     * @param string|null $name
     * @param string|null $content
     * @return array
     */
    public function __invoke(string $name = null, string $content = null): array
    {
        $items = JobCategory::when(isset($name), function ($query) use ($name) {
            return $query->where('name', 'like', "%$name%");
        })->when(isset($content), function ($query) use ($content) {
            return $query->where('content', 'like', "%$content%");
        })->orderBy('sort_no')->get()->toArray();

        // storageパス変換
        if (count($items) >= 1 && array_key_exists('image', $items[0])) {
            foreach ($items as &$item) {
                $item['image_url'] = Storage::url($item['image']);
            }
        }
        return $items;
    }
}
