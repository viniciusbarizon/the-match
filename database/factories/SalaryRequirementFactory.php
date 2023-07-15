<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Currency;
use App\Models\JobSeeker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalaryRequirement>
 */
class SalaryRequirementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'salary' => random_int(1, 16777215),
            'contract_id' => Contract::inRandomOrder()->first()->id,
            'currency_id' => Currency::inRandomOrder()->first()->id,
            'job_seeker_id' => Currency::inRandomOrder()->first()->id,
        ];
    }
}
