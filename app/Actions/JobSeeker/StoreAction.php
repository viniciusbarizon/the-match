<?php

namespace App\Actions;

use App\Models\JobSeeker;
use App\Models\SalaryRequirement;

final class StoreAction
{
    private JobSeeker $jobSeeker;

    public function __construct(
        public readonly string $contractId,
        public readonly string $currencyId,
        public readonly string $email,
        public readonly string $name,
        public readonly string $salary,
        public readonly string $slug,
    ) { }

    public function store(): void
    {
        $this->createJobSeeker();
        $this->createSalaryRequirements();
    }

    private function createJobSeeker(): void
    {
        $this->jobSeeker = JobSeeker::create([
            'email' => $this->email,
            'name' => $this->name,
            'slug' => $this->slug,
        ]);
    }

    private function createSalaryRequirements(): void
    {
        $this->jobSeeker->salaryRequirements()
            ->save($this->getSalaryRequirement());
    }

    private function getSalaryRequirement(): SalaryRequirement
    {
        return new SalaryRequirement([
            'contract_id' => $this->contract_id,
            'currency_id' => $this->contract_id,
            'salary' => $this->salary
        ]);
    }
}
