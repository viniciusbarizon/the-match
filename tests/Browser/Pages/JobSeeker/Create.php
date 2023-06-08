<?php

namespace Tests\Browser\Pages\JobSeeker;

use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Create extends Page
{
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
        $dusk = '@logo';

        $browser->assertVisible($dusk)
            ->assertAttribute($dusk, 'alt', config('app.name'))
            ->assertAttributeContains($dusk, 'src', '/resources/images/logo.png');
    }

    public function assertName(Browser $browser): void
    {
        $dusk = '@name';

        $browser->assertSee(__('Nome'))
            ->assertVisible($dusk)
            ->assertAttribute($dusk, 'autocomplete', 'name')
            ->assertAttribute($dusk, 'maxlength', 255)
            ->assertAttribute($dusk, 'name', 'name')
            ->assertAttribute($dusk, 'required', true)
            ->assertAttribute($dusk, 'type', 'text')
            ->assertAttribute($dusk, 'wire:model.delay', 'name');
    }

    public function assertSlug(Browser $browse): void
    {
        $dusk = '@slug';

        $browse->assertSee(__('Slug'))
            ->assertVisible($dusk)
            ->assertAttribute($dusk, 'maxlength', 255)
            ->assertAttribute($dusk, 'name', 'slug')
            ->assertAttribute($dusk, 'required', true)
            ->assertAttribute($dusk, 'type', 'text')
            ->assertAttribute($dusk, 'wire:model.delay', 'slug');
    }

    public function assertUrl(Browser $browse): void
    {
        $dusk = '@url';

        $browse->assertSee(__('URL'))
            ->assertVisible($dusk)
            ->assertAttribute($dusk, 'readonly', true)
            ->assertAttribute($dusk, 'type', 'text')
            ->assertAttribute($dusk, 'wire:model.defer', 'url');
    }
}
