<?php

use App\Http\Livewire\VerificationCode\Send;
use App\Models\JobSeeker;
use NextApps\VerificationCode\Models\VerificationCode;
use function Pest\Livewire\livewire;

it('validates email as required', function () {
    livewire(Send::class)
        ->call('send')
        ->assertHasErrors(['email' => 'required']);
});

it('validates email with maximum characters reached', function () {
    livewire(Send::class, ['email' => str()->random(256)])
        ->call('send')
        ->assertHasErrors(['email' => 'max']);
});

it('validates email as invalid', function () {
    livewire(Send::class, ['email' => str()->random(25)])
        ->call('send')
        ->assertHasErrors(['email' => 'email']);
});

it('validates email as already in use', function () {
    livewire(Send::class, ['email' => JobSeeker::factory()->create()->email])
        ->call('send')
        ->assertHasErrors(['email' => 'unique']);
});

it('sends', function () {
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
