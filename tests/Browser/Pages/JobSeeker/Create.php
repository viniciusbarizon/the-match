<?php

namespace Tests\Browser\Pages\JobSeeker;

use App\Models\JobSeeker;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Create extends Page
{
    const DUSKS = [
        'logo' => '@logo',
        'name' => '@name',
        'slug' => '@slug',
        'url' => '@url',
    ];

    /**
     * Get the URL for the page.
     */
    public function url(): string
    {
        return '/';
    }

    /**
     * Assert that the browser is on the page.
     */
    public function assert(Browser $browser): void
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array<string, string>
     */
    public function elements(): array
    {
        return [];
    }

    public function assertTitleCreate(Browser $browser): void
    {
        $browser->assertTitle(config('app.name').' - '.
            __('Dê o match da sua pretensão salarial antes de iniciar o processo seletivo')
        );
    }

    public function assertDescription(Browser $browser): void
    {
        $browser->assertSee(
            __('Preencha os dados abaixo, receba um link para compartilhar com as empresas, e saiba antes de iniciar o processo seletivo se o salário ofertado é compatível com a sua pretensão salarial.')
        );
    }

    public function assertLogo(Browser $browser): void
    {
        $browser->assertVisible(self::DUSKS['logo'])
            ->assertAttribute(self::DUSKS['logo'], 'alt', config('app.name'))
            ->assertAttributeContains(self::DUSKS['logo'], 'src', '/resources/images/logo.png');
    }

    public function assertName(Browser $browser): void
    {
        $browser->assertSee(__('Nome'))
            ->assertVisible(self::DUSKS['name'])
            ->assertAttribute(self::DUSKS['name'], 'autocomplete', 'name')
            ->assertAttribute(self::DUSKS['name'], 'maxlength', 255)
            ->assertAttribute(self::DUSKS['name'], 'name', 'name')
            ->assertAttribute(self::DUSKS['name'], 'required', true)
            ->assertAttribute(self::DUSKS['name'], 'type', 'text')
            ->assertAttribute(self::DUSKS['name'], 'wire:model.delay', 'name');
    }

    public function assertSlug(Browser $browse): void
    {
        $browse->assertSee(__('Slug'))
            ->assertVisible(self::DUSKS['slug'])
            ->assertAttribute(self::DUSKS['slug'], 'maxlength', 255)
            ->assertAttribute(self::DUSKS['slug'], 'name', 'slug')
            ->assertAttribute(self::DUSKS['slug'], 'required', true)
            ->assertAttribute(self::DUSKS['slug'], 'type', 'text')
            ->assertAttribute(self::DUSKS['slug'], 'wire:model.delay', 'slug');
    }

    public function assertSlugAndUrlAfterTypeName(Browser $browse): void
    {
        $name = fake()->name();
        $slug = str()->of($name)->slug();

        $browse->type(self::DUSKS['name'], $name)
            ->pause(1000)
            ->assertValue(self::DUSKS['slug'], $slug)
            ->assertValue(self::DUSKS['url'], route('job-seekers.match', ['slug' => $slug]));
    }

    public function assertUrl(Browser $browse): void
    {
        $browse->assertSee(__('URL'))
            ->assertVisible(self::DUSKS['url'])
            ->assertAttribute(self::DUSKS['url'], 'readonly', true)
            ->assertAttribute(self::DUSKS['url'], 'type', 'text')
            ->assertAttribute(self::DUSKS['url'], 'wire:model.defer', 'url');
    }

    public function assertUrlAfterTypeSlug(Browser $browse): void
    {
        $slug = fake()->slug();

        $browse->type(self::DUSKS['slug'], $slug)
            ->pause(1000)
            ->assertValue(self::DUSKS['url'], route('job-seekers.match', ['slug' => $slug]));
    }

    public function assertSlugWithTimeIfExists(Browser $browser): void
    {
        $jobSeeker = JobSeeker::factory()->create();

        $browser->type(self::DUSKS['name'], $jobSeeker->name)
            ->pause(500)
            ->assertValue(self::DUSKS['slug'], str()->of($jobSeeker->name)->slug().'-'.time());
    }
}
