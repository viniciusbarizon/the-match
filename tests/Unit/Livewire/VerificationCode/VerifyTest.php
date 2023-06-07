<?php

use App\Http\Livewire\VerificationCode\Send;
use App\Http\Livewire\VerificationCode\Verify;
use NextApps\VerificationCode\Models\VerificationCode;
use function Pest\Livewire\livewire;

it('can be validated with required code', function () {
    livewire(Verify::class)
        ->call('verify')
        ->assertHasErrors(['verification_code' => 'required']);
});

it('can be validated with code without the right size', function () {
    livewire(Verify::class, ['verification_code' => str()->random(5)])
        ->call('verify')
        ->assertHasErrors(['verification_code' => 'size']);
});

it('can be validated with invalid code without send', function () {
    livewire(Verify::class, ['verification_code' => str()->random(6)])
        ->call('verify')
        ->assertSet('successfully_verified', false);
});

it('can be validated with invalid code after send', function () {
    $email = fake()->email();

    livewire(Send::class, ['email' => $email])
        ->call('send');

    $verificationCode = VerificationCode::where('verifiable', $email)->latest()->first();

    livewire(Verify::class, ['email' => $email, 'verification_code' => str()->random(6)])
        ->call('verify')
        ->assertSet('successfully_verified', false);

    $verificationCode->refresh();

    expect($verificationCode)->not->ToBeNull();
});
