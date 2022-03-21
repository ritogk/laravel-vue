<?php

namespace App\UseCases\Master\Job;

use App\Models\Job;
use Illuminate\Support\Facades\Storage;

class ListAction
{
    /**
     * Undocumented function
     *
     * @param string|null $title
     * @param string|null $content
     * @param boolean|null $attention
     * @param integer|null $job_category_id
     * @param integer|null $price
     * @param string|null $welfare
     * @param string|null $holiday
     * @return array
     */
    public function __invoke(string $title = null, string $content = null, bool $attention = null, int $job_category_id = null, int $price = null, string $welfare = null, string $holiday = null): array
    {
        $items = Job::when(isset($title), function ($query) use ($title) {
            return $query->where('title', 'like', "%$title%");
        })->when(isset($content), function ($query) use ($content) {
            return $query->where('content', 'like', "%$content%");
        })->when($attention, function ($query) use ($attention) {
            return $query->where('attention', $attention);
        })->when(isset($job_category_id), function ($query) use ($job_category_id) {
            return $query->where('job_category_id', $job_category_id);
        })->when(isset($welfare), function ($query) use ($welfare) {
            return $query->where('welfare', 'like', "%$welfare%");
        })->when(isset($holiday), function ($query) use ($holiday) {
            return $query->where('holiday', 'like', "%$holiday%");
        })->when(isset($price), function ($query) use ($price) {
            return $query->where('price', '>=', $price);
        })->with('jobCategory')->orderBy('sort_no')->get()->toArray();

        // ファイルurlを変換
        if (count($items) >= 1 && array_key_exists('image', $items[0])) {
            foreach ($items as &$item) {
                $item['image_url'] = config('filesystems.base_url') . Storage::url($item['image']);
            }
        }

        return $items;
    }
}
