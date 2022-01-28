<?php

namespace App\UseCases\Master\Job;

use App\Models\Job;
use Illuminate\Http\Request;

class CreateAction
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
     * @param string $image
     * @param integer $sort_no
     * @return array
     */
    public function __invoke(string $title = null, string $content = null, bool $attention = null, int $job_category_id = null, int $price = null, string $welfare = null, string $holiday = null, string $image, int $sort_no): array
    {
        $create = [
            'title' => $title,
            'content' => $content,
            'attention' => $attention,
            'job_category_id' => $job_category_id,
            'price' => $price,
            'welfare' => $welfare,
            'holiday' => $holiday,
            'image' => $image,
            'sort_no' => $sort_no,
        ];
        return Job::create($create)->toArray();
    }
}
