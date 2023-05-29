<?php

use App\Http\Livewire\JobSeeker\VerificationCode\Send;
use NextApps\VerificationCode\Models\VerificationCode;
use function Pest\Livewire\livewire;

it('can be validated with required email', function () {
    livewire(Send::class)
        ->call('send')
        ->assertHasErrors(['email' => 'required']);
});

it('can be validated with invalid email', function () {
    livewire(Send::class, ['email' => str()->random(25)])
        ->call('send')
        ->assertHasErrors(['email' => 'email']);
});

it('can be sent', function () {
    $now = strtotime('now');

    livewire(Send::class, ['email' => fake()->email()])
        ->call('send');

    $verificationCode = VerificationCode::latest()->first();

    expect($verificationCode->code)
        ->toBeString()
        ->toHaveLength(60);

    expect(strtotime($verificationCode->expires_at))
        ->toBeGreaterThan($now);

    expect(strtotime($verificationCode->created_at))
        ->toBeGreaterThanOrEqual($now);
});
