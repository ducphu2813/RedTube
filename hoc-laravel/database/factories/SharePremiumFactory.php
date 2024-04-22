<?php

namespace Database\Factories;

use App\Models\PremiumRegistration;
use App\Models\SharePremium;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class SharePremiumFactory extends Factory
{
    protected $model = SharePremium::class;

    public function definition(): array
    {
        return [
            'share_id' => $this->faker->randomNumber(),
            'created_date' => Carbon::now(),

            'user_id' => Users::factory(),
            'premium_registration_id' => PremiumRegistration::factory(),
        ];
    }
}
