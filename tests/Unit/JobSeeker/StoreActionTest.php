<?php

use App\Actions\JobSeeker\StoreAction;
use App\Models\Contract;
use App\Models\Currency;
use App\Models\JobSeeker;
use Database\Seeders\ContractSeeder;
use Database\Seeders\CurrencySeeder;

it('stores an job seeker', function() {
    $contractId = Contract::inRandomOrder()->first()->id;
    $currencyId = Currency::inRandomOrder()->first()->id;
    $salary = random_int(1, 16777215);

    $jobSeekerFactory = JobSeeker::factory()->make();

    $id = (new StoreAction(
        contractId: $contractId,
        currencyId: $currencyId,
        email: $jobSeekerFactory->email,
        name: $jobSeekerFactory->name,
        salary: $salary,
        slug: $jobSeekerFactory->slug,
    ))->store();

    $jobSeeker = JobSeeker::find($id);

    expect($jobSeeker->salaryRequirements()->first()->contract_id)->toEqual($contractId);
    expect($jobSeeker->salaryRequirements()->first()->currency_id)->toEqual($currencyId);
    expect($jobSeeker->email)->toEqual($jobSeekerFactory->email);
    expect($jobSeeker->name)->toEqual($jobSeekerFactory->name);
    expect($jobSeeker->salaryRequirements()->first()->salary)->toEqual($salary);
    expect($jobSeeker->slug)->toEqual($jobSeekerFactory->slug);
});
