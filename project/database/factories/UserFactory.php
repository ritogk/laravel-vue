<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

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
            'self_pr' => $this->faker->realText(1000),
            'tel' => '090-9999-8888',
            'password' => Hash::make('ranasoft'),
            'remember_token' => null,
        ];
    }
}
