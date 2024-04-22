<?php

namespace Database\Factories;

use App\Models\Interaction;
use App\Models\Users;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class InteractionFactory extends Factory
{
    protected $model = Interaction::class;

    public function definition(): array
    {
        return [
            'reaction' => $this->faker->boolean(),
            'created_date' => Carbon::now(),

            'user_id' => Users::factory(),
            'video_id' => Video::factory(),
        ];
    }
}
