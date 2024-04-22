<?php

namespace Database\Factories;

use App\Models\PremiumPackage;
use Illuminate\Database\Eloquent\Factories\Factory;

class PremiumPackageFactory extends Factory
{
    protected $model = PremiumPackage::class;

    public function definition(): array
    {
        return [
            'package_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(),
            'duration' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
            'share_limit' => $this->faker->randomNumber(),
        ];
    }
}
