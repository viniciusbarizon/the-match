<?php

use App\Actions\JobSeeker\StoreAction;
use App\Models\JobSeeker;
use App\Models\SalaryRequirement;

beforeEach(function () {
    $this->jobSeekerFactory = JobSeeker::factory()->make();
    $this->salaryRequirementFactory = SalaryRequirement::factory()->make();

    $this->jobSeeker = (new StoreAction(
        attributes: collect([
            'contract_id' => $this->salaryRequirementFactory->contract_id,
            'currency_id' => $this->salaryRequirementFactory->currency_id,
            'email' => $this->jobSeekerFactory->email,
            'name' => $this->jobSeekerFactory->name,
            'salary' => $this->salaryRequirementFactory->salary,
            'slug' => $this->jobSeekerFactory->slug,
        ])
    ))->store();
});

it('creates an job seeker', function () {
    expect($this->jobSeeker->email)->toEqual($this->jobSeekerFactory->email);
    expect($this->jobSeeker->name)->toEqual($this->jobSeekerFactory->name);
    expect($this->jobSeeker->slug)->toEqual($this->jobSeekerFactory->slug);
});

it('creates a salary requirement', function () {
    $salaryRequirement = $this->jobSeeker->salaryRequirements()->first();

    expect($salaryRequirement->salary)->toEqual($this->salaryRequirementFactory->salary);
    expect($salaryRequirement->contract_id)->toEqual($this->salaryRequirementFactory->contract_id);
    expect($salaryRequirement->currency_id)->toEqual($this->salaryRequirementFactory->currency_id);
});
