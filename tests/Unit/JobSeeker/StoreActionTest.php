<?php

use App\Actions\JobSeeker\StoreAction;
use App\Models\Contract;
use App\Models\Currency;
use App\Models\JobSeeker;
use Database\Seeders\ContractSeeder;
use Database\Seeders\CurrencySeeder;

it('stores an job seeker', function() {
    $this->seed(ContractSeeder::class);
    $this->seed(CurrencySeeder::class);

    $contractId = Contract::inRandomOrder()->first()->id;
    $currencyId = Currency::inRandomOrder()->first()->id;
    $salary = fake()->randomFloat();

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

    //expect($jobSeeker->contract_id)->toBe($contractId);
    //expect($jobSeeker->currency_id)->toBe($currencyId);
    expect($jobSeeker->email)->toBe($jobSeekerFactory->email);
    expect($jobSeeker->name)->toBe($jobSeekerFactory->name);
    //expect($jobSeeker->salary)->toBe($salary);
    expect($jobSeeker->slug)->toBe($jobSeekerFactory->slug);
});
