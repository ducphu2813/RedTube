<?php

namespace Database\Factories;

use App\Models\Follow;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FollowFactory extends Factory
{
    protected $model = Follow::class;

    public function definition(): array
    {
        return [
            'created_date' => Carbon::now(),

            'user_id' => Users::factory(),
            'follower_id' => Users::factory(),
        ];
    }
}
