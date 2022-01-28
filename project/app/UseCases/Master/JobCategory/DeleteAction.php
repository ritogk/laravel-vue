<?php

namespace App\UseCases\Master\JobCategory;

use App\Models\JobCategory;

class DeleteAction
{
    /**
     * __invoke
     *
     * @param string $id
     * @return array
     */
    public function __invoke(string $id): array
    {
        JobCategory::where('id', $id)->delete();
        return JobCategory::where('id', $id)->withTrashed()->first()->toArray();
    }
}
