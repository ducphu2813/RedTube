<?php

namespace Database\Factories;

use App\Models\History;
use App\Models\Users;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class HistoryFactory extends Factory
{
    protected $model = History::class;

    public function definition(): array
    {
        return [
            'history_id' => $this->faker->randomNumber(),
            'created_date' => Carbon::now(),

            'user_id' => Users::factory(),
            'video_id' => Video::factory(),
        ];
    }
}
