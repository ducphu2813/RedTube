<?php

namespace Database\Factories;

use App\Models\Users;
use App\Models\Video;
use App\Models\VideoNotifications;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class VideoNotificationsFactory extends Factory
{
    protected $model = VideoNotifications::class;

    public function definition(): array
    {
        return [
            'notification_id' => $this->faker->randomNumber(),
            'message' => $this->faker->word(),
            'created_date' => Carbon::now(),
            'is_read' => $this->faker->boolean(),

            'user_id' => Users::factory(),
            'video_id' => Video::factory(),
        ];
    }
}
