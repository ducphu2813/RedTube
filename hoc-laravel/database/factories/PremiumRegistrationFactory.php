<?php

namespace Database\Factories;

use App\Models\PremiumPackage;
use App\Models\PremiumRegistration;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PremiumRegistrationFactory extends Factory
{
    protected $model = PremiumRegistration::class;

    public function definition(): array
    {
        return [
            'registration_id' => $this->faker->randomNumber(),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),

            'user_id' => Users::factory(),
            'package_id' => PremiumPackage::factory(),
        ];
    }
}
