<?php

namespace Database\Factories;

use App\Models\Playlist;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlaylistFactory extends Factory
{
    protected $model = Playlist::class;

    public function definition(): array
    {
        return [
            'playlist_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'created_date' => Carbon::now(),

            'user_id' => Users::factory(),
        ];
    }
}
