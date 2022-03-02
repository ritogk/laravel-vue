<?php

namespace App\UseCases\Master\Job;

use App\Models\Job;

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
        Job::where('id', $id)->delete();
        return Job::withTrashed()->where('id', $id)->first()->toArray();
    }
}
