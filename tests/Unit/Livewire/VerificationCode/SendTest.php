<?php

use function Pest\Livewire\livewire;

use App\Http\Livewire\VerificationCode\Send;
use NextApps\VerificationCode\Models\VerificationCode;

it('can be sent', function () {
    $dateBeforeCall = date('Y-m-d H:i:s');

    livewire(Send::class)
        ->set('email', config('mail.from.address'))
        ->call('submit')
        ->assertSee(_('Um código de verificação foi enviado para o seu e-mail.'));
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
