<?php

namespace Database\Factories;

use App\Models\PaymentHistory;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PaymentHistoryFactory extends Factory
{
    protected $model = PaymentHistory::class;

    public function definition(): array
    {
        return [
            'payment_id' => $this->faker->randomNumber(),
            'payment_date' => Carbon::now(),
            'amount' => $this->faker->randomFloat(),
            'full_name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'phone' => $this->faker->phoneNumber(),

            'user_id' => Users::factory(),
        ];
    }
}
