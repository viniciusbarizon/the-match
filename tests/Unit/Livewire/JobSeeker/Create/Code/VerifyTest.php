<?php

use App\Http\Livewire\JobSeeker\Create\Code\Send;
use App\Http\Livewire\JobSeeker\Create\Code\Verify;
use NextApps\VerificationCode\Models\VerificationCode;
use function Pest\Livewire\livewire;

it('validates code as required', function () {
    livewire(Verify::class)
        ->call('verify')
        ->assertHasErrors(['code' => 'required']);
});

it('validates size of the code', function () {
    livewire(Verify::class, ['code' => str()->random(5)])
        ->call('verify')
        ->assertHasErrors(['code' => 'size']);
});

it('validates code as invalid', function () {
    livewire(Verify::class, ['code' => str()->random(6)])
        ->call('verify')
        ->assertSet('successfully_verified', false);
});

it('validates code as invalid after send e-mail', function () {
    $email = fake()->email();

    livewire(Send::class, ['email' => $email])
        ->call('send');

    $verificationCode = VerificationCode::where('verifiable', $email)->latest()->first();

    livewire(Verify::class, ['email' => $email, 'code' => str()->random(6)])
        ->call('verify')
        ->assertSet('successfully_verified', false);

    $verificationCode->refresh();

    expect($verificationCode)->not->ToBeNull();
});
