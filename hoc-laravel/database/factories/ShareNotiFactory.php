<?php

namespace Database\Factories;

use App\Models\PremiumRegistration;
use App\Models\ShareNoti;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ShareNotiFactory extends Factory
{
    protected $model = ShareNoti::class;

    public function definition(): array
    {
        return [
            'noti_id' => $this->faker->randomNumber(),
            'status' => $this->faker->boolean(),
            'created_date' => Carbon::now(),
            'expiry_date' => Carbon::now(),

            'sender_id' => Users::factory(),
            'receiver_id' => Users::factory(),
            'registration_id' => PremiumRegistration::factory(),
        ];
    }
}
