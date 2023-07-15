<?php

use App\Actions\JobSeeker\StoreAction;
use App\Models\Contract;
use App\Models\Currency;
use App\Models\JobSeeker;
use App\Models\SalaryRequirement;
use Database\Seeders\ContractSeeder;
use Database\Seeders\CurrencySeeder;

it('stores an job seeker', function() {
    $jobSeekerFactory = JobSeeker::factory()->make();
    $salaryRequirementFactory = SalaryRequirement::factory()->make();

    $id = (new StoreAction(
        contractId: $salaryRequirementFactory->contract_id,
        currencyId: $salaryRequirementFactory->currency_id,
        email: $jobSeekerFactory->email,
        name: $jobSeekerFactory->name,
        salary: $salaryRequirementFactory->salary,
        slug: $jobSeekerFactory->slug,
    ))->store();

    $jobSeeker = JobSeeker::with('salaryRequirements')
        ->find($id);

    expect($jobSeeker->email)->toEqual($jobSeekerFactory->email);
    expect($jobSeeker->name)->toEqual($jobSeekerFactory->name);
    expect($jobSeeker->slug)->toEqual($jobSeekerFactory->slug);

    expect($jobSeeker->salaryRequirements()->first()->salary)->toEqual($salaryRequirementFactory->salary);
    expect($jobSeeker->salaryRequirements()->first()->contract_id)->toEqual($salaryRequirementFactory->contract_id);
    expect($jobSeeker->salaryRequirements()->first()->currency_id)->toEqual($salaryRequirementFactory->currency_id);
});
