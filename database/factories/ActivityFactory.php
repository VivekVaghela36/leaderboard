<?php

namespace Database\Factories;

use App\Models\Activity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        ini_set('memory_limit', '-1');
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'date' => $this->faker->dateTimeThisYear,
            'points' => 20, // Fixed points value
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
