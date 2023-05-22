<?php

use function Pest\Livewire\livewire;

use App\Http\Livewire\VerificationCode\Send;

it('can be sent', function () {
    livewire(Send::class)
        ->set('email', config('mail.from.address'))
        ->call('submit')
        ->assertOk();
});

it('can be validated with empty email', function () {
    livewire(Send::class)
        ->call('submit')
        ->assertHasErrors(['email' => 'required']);
});

it('can be validated with invalid email', function () {
    livewire(Send::class)
        ->set('email', 'abc')
        ->call('submit')
        ->assertHasErrors(['email' => 'email']);
});
