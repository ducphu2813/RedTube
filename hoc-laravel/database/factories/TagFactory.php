<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'tag_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
        ];
    }
}
