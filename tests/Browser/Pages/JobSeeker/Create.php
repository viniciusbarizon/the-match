<?php

namespace Tests\Browser\Pages\JobSeeker;

use App\Models\JobSeeker;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Create extends Page
{
    private readonly JobSeeker $jobSeeker;

    private string $name;

    private string $slug;

    /**
     * Get the URL for the page.
     */
    public function url(): string
    {
        return '/';
    }

    public function assert(Browser $browser): void
    {
        $browser->assertPathIs($this->url())
            ->assertTitleCreate()
            ->assertLogo()
            ->assertDescription()
            ->assertEmail()
            ->assertButtonSendCode()
            ->assertEmailRequired()
            ->assertEmailInvalid()
            ->assertSendCode()
            ->assertName()
            ->assertSlug()
            ->assertUrl()
            ->assertSlugAndUrlAfterTypeName()
            ->assertUrlAfterTypeSlug()
            ->assertSlugWithTimeIfExists();
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array<string, string>
     */
    public function elements(): array
    {
        return [
            '@email' => '#email',
            '@logo' => '#logo',
            '@name' => '#name',
            '@send_code' => '#send_code',
            '@slug' => '#slug',
            '@url' => '#url',
        ];
    }

    public function assertTitleCreate(Browser $browser): void
    {
        $browser->assertTitle(config('app.name').' - '.
            __('Dê o match da sua pretensão salarial antes de iniciar o processo seletivo')
        );
    }

    public function assertLogo(Browser $browser): void
    {
        $browser->assertVisible('@logo')
            ->assertAttribute('@logo', 'alt', config('app.name'))
            ->assertAttributeContains('@logo', 'src', '/resources/images/logo.png');
    }

    public function assertDescription(Browser $browser): void
    {
        $browser->assertSee(
            __('Preencha os dados abaixo, receba um link para compartilhar com as empresas, e saiba antes de iniciar o processo seletivo se o salário ofertado é compatível com a sua pretensão salarial.')
        );
    }

    public function assertEmail(Browser $browser): void
    {
        $browser->assertSee(__('Email'))
            ->assertVisible('@email')
            ->assertAttribute('@email', 'autocomplete', 'email')
            ->assertAttribute('@email', 'name', 'email')
            ->assertAttribute('@email', 'required', true)
            ->assertAttribute('@email', 'type', 'email')
            ->assertAttribute('@email', 'wire:model.defer', 'email');
    }

    public function assertButtonSendCode(Browser $browser): void
    {
        $browser->assertVisible('@send_code')
            ->assertAttribute('@send_code', 'type', 'button')
            ->assertSeeIn('@send_code', __('Enviar código de verificação'));
    }

    public function assertEmailRequired(Browser $browser): void
    {
        $browser->click('@send_code')
            ->waitForText(__('O campo e-mail é obrigatório.'), 1);
    }

    public function assertEmailInvalid(Browser $browser): void
    {
        $browser->type('@email', str()->random(25))
            ->click('@send_code')
            ->waitForText(__('O campo e-mail não contém um endereço de email válido.'), 1);
    }

    public function assertSendCode(Browser $browser): void
    {
        $browser->type('@email', fake()->email())
            ->click('@send_code')
            ->waitForText(__('Enviamos um código de verificação para o seu e-mail.'), 1);
    }

    public function assertName(Browser $browser): void
    {
        $browser->assertSee(__('Nome'))
            ->assertVisible('@name')
            ->assertAttribute('@name', 'autocomplete', 'name')
            ->assertAttribute('@name', 'maxlength', 255)
            ->assertAttribute('@name', 'name', 'name')
            ->assertAttribute('@name', 'required', true)
            ->assertAttribute('@name', 'type', 'text')
            ->assertAttribute('@name', 'wire:model.delay', 'name');
    }

    public function assertSlug(Browser $browse): void
    {
        $browse->assertSee(__('Slug'))
            ->assertVisible('@slug')
            ->assertAttribute('@slug', 'maxlength', 255)
            ->assertAttribute('@slug', 'name', 'slug')
            ->assertAttribute('@slug', 'required', true)
            ->assertAttribute('@slug', 'type', 'text')
            ->assertAttribute('@slug', 'wire:model.delay', 'slug');
    }

    public function assertUrl(Browser $browse): void
    {
        $browse->assertSee(__('URL'))
            ->assertVisible('@url')
            ->assertAttribute('@url', 'readonly', true)
            ->assertAttribute('@url', 'type', 'text')
            ->assertAttribute('@url', 'wire:model.defer', 'url');
    }

    public function assertSlugAndUrlAfterTypeName(Browser $browse): void
    {
        $this->name = fake()->name();
        $this->slug = str()->of($this->name)->slug();

        $browse->type('@name', $this->name)
            ->pause(1000)
            ->assertValue('@slug', $this->slug)
            ->assertValue('@url', route('job-seekers.match', ['slug' => $this->slug]));
    }

    public function assertUrlAfterTypeSlug(Browser $browse): void
    {
        $this->slug = fake()->slug();

        $browse->type('@slug', $this->slug)
            ->pause(1000)
            ->assertValue('@url', route('job-seekers.match', ['slug' => $this->slug]));
    }

    public function assertSlugWithTimeIfExists(Browser $browser): void
    {
        $this->jobSeeker = JobSeeker::factory()->create();

        $browser->type('@name', $this->jobSeeker->name)
            ->pause(1000)
            ->assertValueIsNot(
                '@slug',
                str()->of($this->jobSeeker->name)->slug()
            );
    }
}
