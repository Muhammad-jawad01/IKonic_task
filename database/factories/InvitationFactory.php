<?php

namespace Database\Factories;

use App\Models\Invitation;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvitationFactory extends Factory
{
    protected $model = Invitation::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->unique()->numberBetween(1, 10),
            'invited_user_id' => $this->faker->unique()->numberBetween(1, 10),
        ];
    }
}
