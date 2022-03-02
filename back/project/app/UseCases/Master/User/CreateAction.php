<?php

namespace App\UseCases\Master\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAction
{
    /**
     * Undocumented function
     *
     * @param string $name
     * @param string $email
     * @param string $password
     * @param string $self_pr
     * @param string $tel
     * @return array
     */
    public function __invoke(string $name, string $email, string $password, string $self_pr, string $tel): array
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'self_pr' => $self_pr,
            'tel' => $tel,
        ])->toArray();
    }
}
