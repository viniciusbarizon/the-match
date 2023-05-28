<?php

use App\Http\Livewire\JobSeeker\VerificationCode\Send;

use function Pest\Livewire\livewire;

it('can be sent', function () {
    livewire(Send::class, ['email' => fake()->email()])
        ->call('send')
        ->assertSee(_('Enviamos um código de verificação para o seu e-mail.'));
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
