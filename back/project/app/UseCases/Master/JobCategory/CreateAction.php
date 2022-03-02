<?php

namespace App\UseCases\Master\JobCategory;

use App\Models\JobCategory;
use Illuminate\Http\Request;

class CreateAction{
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
        return JobCategory::create($create)->toArray();
    }
}
