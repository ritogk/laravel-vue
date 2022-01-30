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
        return JobCategory::withTrashed()->where('id', $id)->first()->toArray();
    }
}
