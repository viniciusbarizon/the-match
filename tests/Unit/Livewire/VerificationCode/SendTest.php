<?php

use App\Http\Livewire\VerificationCode\Send;
use function Pest\Livewire\livewire;

it('can be sent', function () {
    livewire(Send::class, ['email' => config('mail.from.address')])
        ->call('submit')
        ->assertSee(_('Um código de verificação foi enviado para o seu e-mail.'));
});

it('can be validated with empty email', function () {
    livewire(Send::class)
        ->call('submit')
        ->assertHasErrors(['email' => 'required']);
});

it('can be validated with invalid email', function () {
    livewire(Send::class, ['email' => 'abc'])
        ->call('submit')
        ->assertHasErrors(['email' => 'email']);
});
