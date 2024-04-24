<?php

namespace Database\Factories;

use App\Models\Playlist;
use App\Models\PlaylistVideo;
use App\Models\Video;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaylistVideoFactory extends Factory
{
    protected $model = PlaylistVideo::class;

    public function definition(): array
    {
        return [

            'playlist_id' => Playlist::factory(),
            'video_id' => Video::factory(),
        ];
    }
}
