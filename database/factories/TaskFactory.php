<?php

namespace Database\Factories;

use App\Models\Skill;
use App\Enums\Urgency;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'required_skill_id' => Skill::factory(),
            'urgency' => fake()->randomElement([Urgency::high, Urgency::medium, Urgency::low]),
            'duration' => fake()->numberBetween(1, 3),
            'required_technicians' => fake()->numberBetween(1, 3),
        ];
    }
}
