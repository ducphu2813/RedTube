<?php

namespace Database\Factories;

use App\Models\Membership;
use App\Models\UserMembership;
use App\Models\Users;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserMembershipFactory extends Factory
{
    protected $model = UserMembership::class;

    public function definition(): array
    {
        return [
            'subscription_id' => $this->faker->randomNumber(),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),

            'user_id' => Users::factory(),
            'membership_id' => Membership::factory(),
        ];
    }
}
