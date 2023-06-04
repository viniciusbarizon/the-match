<?php

use App\Http\Livewire\JobSeeker\CreateOrEdit\Url;
use App\Models\JobSeeker;
use function Pest\Livewire\livewire;

it('sets slug automatically after type name', function () {
    $name = fake()->name();

    livewire(Url::class)
        ->set('name', $name)
        ->assertSet('slug', str()->of($name)->slug());
});

it('sets url automatically after type name', function () {
    $name = fake()->name();

    livewire(Url::class)
        ->set('name', $name)
        ->assertSet('url', route('job-seekers.match', ['slug' => str()->of($name)->slug()]));
});

it('sets url automatically after type slug', function () {
    $slug = fake()->slug();

    livewire(Url::class)
        ->set('slug', $slug)
        ->assertSet('url', route('job-seekers.match', ['slug' => $slug]));
});

it('sets url empty after clear name', function () {
    livewire(Url::class)
        ->set('name', fake()->name())
        ->set('name', '')
        ->assertSet('url', '');
});

it('sets url empty after clear slug', function () {
    livewire(Url::class)
        ->set('slug', fake()->slug())
        ->set('slug', '')
        ->assertSet('url', '');
});

it('sets slug with time if already exists', function () {
    $jobSeeker = JobSeeker::factory()->create();

    livewire(Url::class)
        ->set('name', $jobSeeker->name)
        ->assertSet('slug', $jobSeeker->slug.'-'.time());
});

it('sets urls with time if slug already exists', function () {
    $jobSeeker = JobSeeker::factory()->create();

    livewire(Url::class)
        ->set('name', $jobSeeker->name)
        ->assertSet('url', route('job-seekers.match', ['slug' => $jobSeeker->slug.'-'.time()]));
});
