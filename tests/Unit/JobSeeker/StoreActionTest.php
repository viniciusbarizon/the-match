<?php

use App\Actions\JobSeeker\StoreAction;
use App\Models\Contract;
use App\Models\Currency;
use App\Models\JobSeeker;
use App\Models\SalaryRequirement;

private JobSeeker $jobSeeker;
private JobSeeker $jobSeekerFactory;
private SalaryRequirement $salaryRequirementFactory;

beforeAll(function () {
    $this->jobSeekerFactory = JobSeeker::factory()->make();
    $this->salaryRequirementFactory = SalaryRequirement::factory()->make();

    $this->jobSeeker = (new StoreAction(
        contractId: $salaryRequirementFactory->contract_id,
        currencyId: $salaryRequirementFactory->currency_id,
        email: $jobSeekerFactory->email,
        name: $jobSeekerFactory->name,
        salary: $salaryRequirementFactory->salary,
        slug: $jobSeekerFactory->slug,
    ))->store();
});

it('creates an job seeker', function() {
    $jobSeeker = JobSeeker::find($id);
    $salaryRequirement = $jobSeeker->salaryRequirements()->first();

    expect($jobSeeker->email)->toEqual($jobSeekerFactory->email);
    expect($jobSeeker->name)->toEqual($jobSeekerFactory->name);
    expect($jobSeeker->slug)->toEqual($jobSeekerFactory->slug);

    expect($salaryRequirement->salary)->toEqual($salaryRequirementFactory->salary);
    expect($salaryRequirement->contract_id)->toEqual($salaryRequirementFactory->contract_id);
    expect($salaryRequirement->currency_id)->toEqual($salaryRequirementFactory->currency_id);
});
