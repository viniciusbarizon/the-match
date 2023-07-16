<?php

namespace App\Actions\JobSeeker;

use App\Mail\JobSeeker\Stored;
use App\Models\JobSeeker;
use App\Models\SalaryRequirement;
use Illuminate\Support\Facades\Mail;

final class StoreAction
{
    private JobSeeker $jobSeeker;

    public function __construct(
        public readonly string $contractId,
        public readonly string $currencyId,
        public readonly string $email,
        public readonly string $name,
        public readonly int $salary,
        public readonly string $slug,
    ) { }

    public function store(): JobSeeker
    {
        session()->invalidate();

        $this->createJobSeeker();
        $this->createSalaryRequirements();
        $this->refreshJobSeeker();

        $this->sendEmail();

        return $this->jobSeeker;
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

    private function refreshJobSeeker(): void
    {
        $this->jobSeeker->refresh();
    }

    private function sendEmail(): void
    {
        Mail::to($this->email)->send(
            new Stored($this->name, $this->slug)
        );
    }
}
