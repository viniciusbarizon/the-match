<?php

namespace Tests\Browser\Pages\JobSeeker;

use App\Models\JobSeeker;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page;

class Create extends Page
{
    private Browser $browser;

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
        $this->browser = $browser;

        $this->browser->assertPathIs($this->url())
            ->assertTitleCreate()
            ->assertLogo()
            ->assertDescription()
            ->assertEmail()
            ->assertButtonSendCode()
            ->assertEmailRequired()
            ->assertEmailInvalid()
            ->assertSendCode()
            ->assertVerificationCode()
            ->assertButtonVerifyCode()
            ->assertVerificationCodeRequired()
            ->assertVerificationCodeMinimumLength()
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
            '@verification_code' => '#verification_code',
            '@verify_code' => '#verify_code',
        ];
    }

    public function assertTitleCreate(): void
    {
        $this->browser->assertTitle(config('app.name').' - '.
            __('Dê o match da sua pretensão salarial antes de iniciar o processo seletivo')
        );
    }

    public function assertLogo(): void
    {
        $this->browser->assertVisible('@logo')
            ->assertAttribute('@logo', 'alt', config('app.name'))
            ->assertAttributeContains('@logo', 'src', '/resources/images/logo.png');
    }

    public function assertDescription(): void
    {
        $this->browser->assertSee(
            __('Preencha os dados abaixo, receba um link para compartilhar com as empresas, e saiba antes de iniciar o processo seletivo se o salário ofertado é compatível com a sua pretensão salarial.')
        );
    }

    public function assertEmail(): void
    {
        $this->browser->assertSee(__('Email'))
            ->assertVisible('@email')
            ->assertAttribute('@email', 'autocomplete', 'email')
            ->assertAttribute('@email', 'name', 'email')
            ->assertAttribute('@email', 'required', true)
            ->assertAttribute('@email', 'type', 'email')
            ->assertAttribute('@email', 'wire:model.defer', 'email');
    }

    public function assertButtonSendCode(): void
    {
        $this->browser->assertVisible('@send_code')
            ->assertAttribute('@send_code', 'type', 'button')
            ->assertSeeIn('@send_code', __('Enviar código de verificação'));
    }

    public function assertEmailRequired(): void
    {
        $this->browser->click('@send_code')
            ->waitForText(__('O campo e-mail é obrigatório.'), 1);
    }

    public function assertEmailInvalid(): void
    {
        $this->browser->type('@email', str()->random(25))
            ->click('@send_code')
            ->waitForText(__('O campo e-mail não contém um endereço de email válido.'), 1);
    }

    public function assertSendCode(): void
    {
        $this->browser->type('@email', fake()->email())
            ->click('@send_code')
            ->waitForText(__('Enviamos um código de verificação para o seu e-mail.'), 1);
    }

    public function assertVerificationCode(): void
    {
        $this->browser->assertSee(__('Código'))
            ->assertVisible('@verification_code')
            ->assertAttribute('@verification_code', 'autocomplete', 'off')
            ->assertAttribute('@verification_code', 'maxlength', 6)
            ->assertAttribute('@verification_code', 'name', 'verification_code')
            ->assertAttribute('@verification_code', 'type', 'text')
            ->assertAttribute('@verification_code', 'wire:model.defer', 'verification_code');
    }

    public function assertButtonVerifyCode(): void
    {
        $this->browser->assertVisible('@verify_code')
            ->assertAttribute('@verify_code', 'type', 'button')
            ->assertSeeIn('@verify_code', __('Verificar código'));
    }

    public function assertVerificationCodeRequired(): void
    {
        $this->browser->click('@verify_code')
            ->waitForText(__('O campo Código é obrigatório.'), 1);
    }

    public function assertVerificationCodeMinimumLength(): void
    {
        $this->browser->type('@verification_code', str()->random(5))
            ->click('@verify_code')
            ->waitForText(__('O campo Código deve conter 6 caracteres.'), 1);
    }

    public function assertName(): void
    {
        $this->browser->assertSee(__('Nome'))
            ->assertVisible('@name')
            ->assertAttribute('@name', 'autocomplete', 'name')
            ->assertAttribute('@name', 'maxlength', 255)
            ->assertAttribute('@name', 'name', 'name')
            ->assertAttribute('@name', 'required', true)
            ->assertAttribute('@name', 'type', 'text')
            ->assertAttribute('@name', 'wire:model.delay', 'name');
    }

    public function assertSlug(): void
    {
        $this->browser->assertSee(__('Slug'))
            ->assertVisible('@slug')
            ->assertAttribute('@slug', 'maxlength', 255)
            ->assertAttribute('@slug', 'name', 'slug')
            ->assertAttribute('@slug', 'required', true)
            ->assertAttribute('@slug', 'type', 'text')
            ->assertAttribute('@slug', 'wire:model.delay', 'slug');
    }

    public function assertUrl(): void
    {
        $this->browser->assertSee(__('URL'))
            ->assertVisible('@url')
            ->assertAttribute('@url', 'readonly', true)
            ->assertAttribute('@url', 'type', 'text')
            ->assertAttribute('@url', 'wire:model.defer', 'url');
    }

    public function assertSlugAndUrlAfterTypeName(): void
    {
        $this->name = fake()->name();
        $this->slug = str()->of($this->name)->slug();

        $this->browser->type('@name', $this->name)
            ->pause(1000)
            ->assertValue('@slug', $this->slug)
            ->assertValue('@url', route('job-seekers.match', ['slug' => $this->slug]));
    }

    public function assertUrlAfterTypeSlug(): void
    {
        $this->slug = fake()->slug();

        $this->browser->type('@slug', $this->slug)
            ->pause(1000)
            ->assertValue('@url', route('job-seekers.match', ['slug' => $this->slug]));
    }

    public function assertSlugWithTimeIfExists(): void
    {
        $this->jobSeeker = JobSeeker::factory()->create();

        $this->browser->type('@name', $this->jobSeeker->name)
            ->pause(1000)
            ->assertValueIsNot(
                '@slug',
                str()->of($this->jobSeeker->name)->slug()
            );
    }
}
