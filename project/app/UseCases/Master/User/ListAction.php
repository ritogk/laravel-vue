<?php

namespace App\UseCases\Master\User;

use App\Models\User;

class ListAction
{
    /**
     * Undocumented function
     *
     * @param string|null $name
     * @param string|null $email
     * @param string|null $self_pr
     * @param string|null $tel
     * @return array
     */
    public function __invoke(string $name = null, string $email = null, string $self_pr = null, string $tel = null): array
    {
        $items = User::when(isset($name), function ($query) use ($name) {
            return $query->where('name', 'like', "%$name%");
        })->when(isset($email), function ($query) use ($email) {
            return $query->where('email', 'like', "%$email%");
        })->when(isset($self_pr), function ($query) use ($self_pr) {
            return $query->where('self_pr', 'like', "%$self_pr%");
        })->when(isset($tel), function ($query) use ($tel) {
            return $query->where('tel', 'like', "%$tel%");
        })->orderBy('id')->get()->toArray();
        return $items;
    }
}
