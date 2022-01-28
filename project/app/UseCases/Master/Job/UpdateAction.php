<?php

namespace App\UseCases\Master\Job;

use App\Models\Job;

class UpdateAction
{
    /**
     * Undocumented function
     *
     * @param integer $id
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
    public function __invoke(int $id, string $title = null, string $content = null, bool $attention = null, int $job_category_id = null, int $price = null, string $welfare = null, string $holiday = null, string $image, int $sort_no): array
    {
        $update = [
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
        Job::where('id', $id)->update($update);
        return Job::where('id', $id)->first()->toArray();
    }
}
