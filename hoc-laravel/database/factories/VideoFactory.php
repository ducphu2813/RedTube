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
            'video_id' => $this->faker->randomNumber(),
            'title' => $this->faker->word(),
            'created_date' => Carbon::now(),
            'view' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
            'display_mode' => $this->faker->boolean(),
            'membership' => $this->faker->boolean(),
            'active' => $this->faker->boolean(),
            'video_path' => $this->faker->word(),
            'thumbnail_path' => $this->faker->word(),

            'users_id' => Users::factory(),
        ];
    }
}
