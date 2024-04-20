<?php

namespace Database\Factories;

use App\Models\Users;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VideoFactory extends Factory
{
    protected $model = Video::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'video_id' => $this->faker->randomNumber(),
            'title' => $this->faker->word(),

            'user_id' => Users::factory(),
        ];
    }
}
