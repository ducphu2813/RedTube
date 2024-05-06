<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Users;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'comment_id' => $this->faker->randomNumber(),
            'reply_id' => $this->faker->randomNumber(),
            'content' => $this->faker->word(),
            'created_date' => Carbon::now(),

            'user_id' => Users::factory(),
            'video_id' => Video::factory(),
        ];
    }
}
