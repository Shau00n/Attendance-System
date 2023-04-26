<?php

namespace Database\Factories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttendanceFactory extends Factory
{
    protected $model = Attendance::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'clock_in' => $this->faker->dateTimeBetween('-1 week', 'now'),
            'clock_out' => $this->faker->optional()->dateTimeBetween('-1 week', 'now'),
        ];
    }
}
