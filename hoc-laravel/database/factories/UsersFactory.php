<?php

namespace Database\Factories;

use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UsersFactory extends Factory
{
    protected $model = Users::class;

    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'user_name' => $this->faker->userName(),
            'channel_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt($this->faker->password()),
            'description' => $this->faker->text(),
            'created_date' => Carbon::now(),
            'active' => $this->faker->boolean(),
            'picture_url' => $this->faker->url(),
            'role' => $this->faker->randomNumber(),
        ];
    }
}
