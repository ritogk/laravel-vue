<?php

namespace App\UseCases\Master\Entry;

use App\Models\Entry;
use \DB;

class ListAction
{
    /**
     * Undocumented function
     *
     * @param integer|null $job_id
     * @param integer|null $job_category_id
     * @param string|null $user_name
     * @param string|null $self_pr
     * @return array
     */
    public function __invoke(int $job_id = null, int $job_category_id = null, $user_name = null, $self_pr = null): array
    {
        return Entry::select(['id as entry_id', 'created_at as entry_date', 'job_id', 'user_id'])
            ->when(isset($job_id), function ($query) use ($job_id) {
                return $query->where('job_id', $job_id);
            })->whereHas('job', function ($query) use ($job_category_id) {
                $query->when(isset($job_category_id), function ($query) use ($job_category_id) {
                    return $query->where('job_category_id', $job_category_id);
                });
            })->whereHas('user', function ($query) use ($user_name, $self_pr) {
                $query->when(isset($user_name), function ($query) use ($user_name) {
                    return $query->where('name', 'like', "%$user_name%");
                });
                $query->when(isset($self_pr), function ($query) use ($self_pr) {
                    return $query->where('self_pr', 'like', "%$self_pr%");
                });
            })->with(['job.jobCategory', 'user'])->orderBy('created_at')->get()->toArray();
    }
}
