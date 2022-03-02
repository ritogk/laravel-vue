<?php

namespace App\UseCases\Master\JobCategory;

use App\Models\JobCategory;
use Illuminate\Http\Request;

class UpdateAction
{
    /**
     * Undocumented function
     *
     * @param string $id
     * @param string $name
     * @param string $content
     * @param string $image
     * @param integer $sort_no
     * @return array
     */
    public function __invoke(string $id, string $name, string $content, string $image, int $sort_no): array
    {
        $update = [
            'name' => $name,
            'content' => $content,
            'image' => $image,
            'sort_no' => $sort_no,
        ];
        JobCategory::where('id', $id)->update($update);
        return JobCategory::where('id', $id)->first()->toArray();
    }
}
