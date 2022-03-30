<?php

namespace Database\Factories;

use App\Models\AdminUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdminUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // データをセット
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'email_verified_at' => null,
            'password' => Hash::make('test'),
            'remember_token' => null,
        ];
    }
}
