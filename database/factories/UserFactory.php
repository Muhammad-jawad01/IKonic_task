<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => 'admin' . rand(1, 100000) . '@admin.com',
            'password' => bcrypt('password'), // Default password for testing purposes

            // Other attributes
        ];
    }
}
