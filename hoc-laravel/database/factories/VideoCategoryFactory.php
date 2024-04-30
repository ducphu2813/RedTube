<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoCategoryFactory extends Factory
{
    protected $model = VideoCategory::class;

    public function definition(): array
    {
        return [

            'video_id' => Video::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
