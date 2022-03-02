<?php

namespace App\UseCases\Master\Entry;

use App\Models\Entry;

class ListAction
{
    /**
     * Undocumented function
     *
     * @param integer|null $job_id
     * @param integer|null $job_category_id
     * @return array
     */
    public function __invoke(int $job_id = null, int $job_category_id = null): array
    {
        return Entry::when(isset($title), function ($query) use ($job_id) {
            return $query->where('job_id', $job_id);
        })->when(isset($title), function ($query) use ($job_category_id) {
            return $query->where('job_category_id', $job_category_id);
        })->orderBy('created_at')->get()->toArray();
    }
}
