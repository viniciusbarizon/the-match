<?php

use App\Http\Livewire\JobSeeker\VerificationCode\Send;
use App\Http\Livewire\JobSeeker\VerificationCode\Verify;

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

it()
