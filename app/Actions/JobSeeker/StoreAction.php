<?php

namespace App\Actions\JobSeeker;

use App\Interfaces\JobSeekerInterface;
use App\Mail\JobSeeker\Stored;
use App\Models\JobSeeker;
use App\Models\SalaryRequirement;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

final class StoreAction implements JobSeekerInterface
{
    private readonly Collection $attributes;

    private readonly JobSeeker $jobSeeker;

    public function store(Collection $attributes): string
    {
        $this->attributes = $attributes;

        $this->createJobSeeker();
        $this->createSalaryRequirements();

        $this->sendEmail();

        return $this->jobSeeker->id;
    }

    private function createJobSeeker(): void
    {
        $this->jobSeeker = JobSeeker::create([
            'email' => $this->attributes->get('email'),
            'name' => $this->attributes->get('name'),
            'slug' => $this->attributes->get('slug'),
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
            'contract_id' => $this->attributes->get('contract_id'),
            'currency_id' => $this->attributes->get('currency_id'),
            'salary' => $this->attributes->get('salary'),
        ]);
    }

    private function sendEmail(): void
    {
        Mail::to($this->attributes->get('email'))->send(
            new Stored(
                name: $this->attributes->get('name'),
                slug: $this->attributes->get('slug')
            )
        );
    }
}
