<?php

namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobApplication>
 */
class JobApplicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::where('role', 'member')->inRandomOrder()->first()->id,
            'job_id' => Job::inRandomOrder()->first()->id,
            'resume' => $this->faker->fileExtension(),
            'title' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
        ];
    }
}
