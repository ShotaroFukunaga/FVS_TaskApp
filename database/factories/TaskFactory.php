<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_email' => User::factory(),
            'title' => $this->faker->realtext(10),
            'content' => $this->faker->realText(100),
            'status' => '1',
            'deadline' => $this->faker->dateTime(),
        ];
    }
}
