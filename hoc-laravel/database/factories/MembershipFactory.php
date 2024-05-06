<?php

namespace Database\Factories;

use App\Models\Membership;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;

class MembershipFactory extends Factory
{
    protected $model = Membership::class;

    public function definition(): array
    {
        return [
            'membership_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(),
            'description' => $this->faker->text(),
            'duration' => $this->faker->randomNumber(),

            'user_id' => Users::factory(),
        ];
    }
}
