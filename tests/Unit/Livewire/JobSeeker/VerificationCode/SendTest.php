<?php

use App\Http\Livewire\JobSeeker\VerificationCode\Send;
use NextApps\VerificationCode\Models\VerificationCode;

use function Pest\Livewire\livewire;

it('can be sent and verified', function () {
    $email = fake()->email();
    $now = strtotime('now');

    livewire(Send::class, ['email' => $email])
        ->call('send');

    $verificationCode = VerificationCode::where('verifiable', $email)->latest()->first();

    expect($verificationCode->code)
        ->toBeString()
        ->toHaveLength(60);

    expect(strtotime($verificationCode->expires_at))
        ->toBeGreaterThan($now);

    expect(strtotime($verificationCode->created_at))
        ->toBeGreaterThanOrEqual($now);
});

it('can be validated with empty email', function () {
    livewire(Send::class)
        ->call('send')
        ->assertHasErrors(['email' => 'required']);
});

it('can be validated with invalid email', function () {
    livewire(Send::class, ['email' => str()->random(25)])
        ->call('send')
        ->assertHasErrors(['email' => 'email']);
});
