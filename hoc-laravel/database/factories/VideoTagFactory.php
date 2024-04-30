<?php

namespace Database\Factories;

use App\Models\Tag;
use App\Models\Video;
use App\Models\VideoTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class VideoTagFactory extends Factory
{
    protected $model = VideoTag::class;

    public function definition(): array
    {
        return [

            'video_id' => Video::factory(),
            'tag_id' => Tag::factory(),
        ];
    }
}
