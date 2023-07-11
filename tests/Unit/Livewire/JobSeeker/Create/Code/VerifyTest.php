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
    session()->put('email', fake()->email());

    livewire(Verify::class, ['code' => str()->random(6)])
        ->call('verify')
        ->assertSee(__('Código inválido, por favor tente novamente.'));
});

it('is not disabled if session is_email_verified is false', function () {
    session()->put('email', fake()->email());
    session()->put('is_email_verified', false);

    livewire(Verify::class, ['code' => str()->random(6)])
        ->call('verify')
        ->assertSet('disabled', false);
});

it('is disabled if session is_email_verified is true', function () {
    session()->put('email', fake()->email());
    session()->put('is_email_verified', true);

    livewire(Verify::class, ['code' => str()->random(6)])
        ->call('verify')
        ->assertSet('disabled', true);
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
