<?php

use App\Http\Livewire\JobSeeker\CreateOrEdit\Url;
use function Pest\Livewire\livewire;

it('can set slug automatically after type name', function() {
    $fakeName = fake()->name();

    livewire(Url::class)
        ->set('name', $fakeName)
        ->assertSet('slug', str()->of($fakeName)->slug());
});

it('can set url automatically after type name', function() {
    $fakeName = fake()->name();

    livewire(Url::class)
        ->set('name', $fakeName)
        ->assertSet('url', route('job-seekers.match', ['slug' => str()->of($fakeName)->slug()]));
});

it('can set url automatically after type slug', function() {
    $slug = fake()->slug();

    livewire(Url::class)
        ->set('slug', $slug)
        ->assertSet('url', route('job-seekers.match', ['slug' => $slug]));
});

it('can set url empty after clear name', function() {
    livewire(Url::class)
        ->set('name', fake()->name())
        ->set('name', '')
        ->assertSet('url', '');
});

it('can set url empty after clear slug', function() {
    livewire(Url::class)
        ->set('slug', fake()->slug())
        ->set('slug', '')
        ->assertSet('url', '');
});
