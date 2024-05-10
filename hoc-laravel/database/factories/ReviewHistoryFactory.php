<?php

namespace Database\Factories;

use App\Models\ReviewHistory;
use App\Models\Users;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ReviewHistoryFactory extends Factory
{
    protected $model = ReviewHistory::class;

    public function definition(): array
    {
        return [
            'review_id' => $this->faker->randomNumber(),
            'note' => $this->faker->word(),
            'review_date' => Carbon::now(),
            'review_status' => $this->faker->boolean(),

            'reviewer_id' => Users::factory(),
            'video_id' => Video::factory(),
        ];
    }
}
