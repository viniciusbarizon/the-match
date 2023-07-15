<?php

namespace App\Actions\JobSeeker;

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

    public function store(): string
    {
        $this->createJobSeeker();
        $this->createSalaryRequirements();

        return $this->jobSeeker->id;
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
            'contract_id' => $this->contractId,
            'currency_id' => $this->currencyId,
            'salary' => $this->salary,
        ]);
    }
}
