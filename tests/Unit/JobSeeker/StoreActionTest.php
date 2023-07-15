<?php

use App\Actions\JobSeeker\StoreAction;
use App\Models\Contract;
use App\Models\Currency;
use App\Models\JobSeeker;

it('stores an job seeker', function() {
    $email = fake()->email;

    (new StoreAction)->store(
        contractId: Contract::inRandomOrder()->first()->id,
        currencyId: Currency::inRandomOrder()->first()->id,
        email: fake()->email,
        name: fake()->name,
        slug: fake()->slug,
    );

    expect(JobSeeker::where('email', $email)->exists())->toBeTrue();
});
