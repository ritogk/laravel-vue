<?php

namespace App\UseCases\Master\Entry;

use App\Models\Entry;
use Illuminate\Http\Request;

class CreateAction{
    /**
     * Undocumented function
     *
     * @param integer $job_id
     * @param integer $user_id
     * @return array
     */
    public function __invoke(int $job_id, int $user_id): array
    {
        $create = [
            'job_id' => $job_id,
            'user_id' => $user_id,
        ];
        return Entry::create($create)->toArray();
    }
}
