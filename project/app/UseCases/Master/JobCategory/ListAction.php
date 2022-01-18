<?php

namespace App\UseCases\Master\JobCategory;

use App\Models\JobCategory;
use Illuminate\Support\Facades\Storage;

class ListAction
{
    /**
     * __invoke
     *
     * @param string $name
     * @return array
     */
    public function __invoke(string $name = null): array
    {
        $items = JobCategory::when(isset($name), function ($query) use ($name) {
            return $query->where('name', 'like', "%$name%");
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
