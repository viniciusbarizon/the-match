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
    $slug = str()->of(fake()->name())->slug();

    livewire(Url::class)
        ->set('slug', $slug)
        ->assertSet('url', route('job-seekers.match', ['slug' => $slug]));
});
