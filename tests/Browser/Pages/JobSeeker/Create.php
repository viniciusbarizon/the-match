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
            ->assertVerifyCodeIsDisabled()
            ->assertEmail()
            ->assertButtonSendCode()
            ->assertEmailRequired()
            ->assertEmailInvalid()
            ->assertEmailMaximumCharactersReached()
            ->assertEmailAlreadyInUse()
            ->assertCode()
            ->assertEmailMustBeVerified()
            ->assertSendCode()
            ->assertButtonVerifyCode()
            ->assertCodeRequired()
            ->assertCodeMinimumLength()
            ->assertCodeInvalid()
            ->assertCodeInvalidAfterSendCode()
            ->assertName()
            ->assertSlug()
            ->assertUrl()
            ->assertSlugAndUrlAfterTypeName()
            ->assertUrlAfterTypeSlug()
            ->assertSlugWithTimeIfExists()
            ->assertContract()
            ->assertCurrency()
            ->assertSalary();
    }

    /**
     * Get the element shortcuts for the page.
     *
     * @return array<string, string>
     */
    public function elements(): array
    {
        return [
            '@code' => '#code',
            '@contract_id' => '#contract_id',
            '@currency_id' => '#currency_id',
            '@create_profile' => '#create_profile',
            '@email' => '#email',
            '@logo' => '#logo',
            '@name' => '#name',
            '@salary' => '#salary',
            '@send_code' => '#send_code',
            '@slug' => '#slug',
            '@url' => '#url',
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

    public function assertVerifyCodeIsDisabled(): void
    {
        $this->browser->assertDisabled('@code')
            ->assertDisabled('@verify_code');
    }

    public function assertEmail(): void
    {
        $this->browser->assertVisible('@email_label')
            ->assertAttribute('@email_label', 'for', 'email')
            ->assertSeeIn('@email_label', __('E-mail'))
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

    public function assertEmailMaximumCharactersReached(): void
    {
        $this->browser->type('@email', str()->random(256))
            ->click('@send_code')
            ->waitForText(__('O campo e-mail não pode conter mais de 255 caracteres.'), 1);
    }

    public function assertEmailAlreadyInUse(): void
    {
        $this->browser->type('@email', JobSeeker::factory()->create()->email)
            ->click('@send_code')
            ->waitForText(__('O valor informado para o campo e-mail já está em uso.'), 1);
    }

    public function assertCode(): void
    {
        $this->browser->assertVisible('@code_label')
            ->assertAttribute('@code_label', 'for', 'code')
            ->assertSeeIn('@code_label', __('Código'))
            ->assertVisible('@code')
            ->assertAttribute('@code', 'autocomplete', 'off')
            ->assertAttribute('@code', 'maxlength', 6)
            ->assertAttribute('@code', 'type', 'text')
            ->assertAttribute('@code', 'wire:model.defer', 'code')
            ->assertDisabled('@code');
    }

    public function assertEmailMustBeVerified(): void
    {
        $this->browser->type('@email', fake()->email())
            ->type('@name', fake()->name())
            ->pause(500)
            ->type('@salary', rand(1, 10000))
            ->clickAndWaitForReload('@create_profile')
            ->assertSee(__('O e-mail precisa ser verificado.'))
            ->click('@send_code')
            ->waitForText(__('Enviamos um código de verificação para o seu e-mail.'), 1)
            ->clickAndWaitForReload('@create_profile')
            ->assertSee(__('O e-mail precisa ser verificado.'));
    }

    public function assertSendCode(): void
    {
        $this->browser->type('@email', fake()->email())
            ->click('@send_code')
            ->waitForText(__('Enviamos um código de verificação para o seu e-mail.'), 1)
            ->assertEnabled('@code')
            ->assertEnabled('@verify_code');
    }

    public function assertButtonVerifyCode(): void
    {
        $this->browser->assertVisible('@verify_code')
            ->assertAttribute('@verify_code', 'type', 'button')
            ->assertSeeIn('@verify_code', __('Verificar código'));
    }

    public function assertCodeRequired(): void
    {
        $this->browser->click('@verify_code')
            ->waitForText(__('O campo código é obrigatório.'), 1);
    }

    public function assertCodeMinimumLength(): void
    {
        $this->browser->type('@code', str()->random(5))
            ->click('@verify_code')
            ->waitForText(__('O campo código deve conter 6 caracteres.'), 1);
    }

    public function assertCodeInvalid(): void
    {
        $this->browser->type('@code', str()->random(6))
            ->click('@verify_code')
            ->waitForText(__('Código inválido, por favor tente novamente.'), 1);
    }

    public function assertCodeInvalidAfterSendCode(): void
    {
        $this->browser->type('@email', fake()->email())
            ->click('@send_code')
            ->type('@code', str()->random(6))
            ->click('@verify_code')
            ->waitForText(__('Código inválido, por favor tente novamente.'), 1);
    }

    public function assertName(): void
    {
        $this->browser->assertVisible('@name_label')
            ->assertAttribute('@name_label', 'for', 'name')
            ->assertSeeIn('@name_label', __('Nome'))
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
        $this->browser->assertVisible('@slug_label')
            ->assertAttribute('@slug_label', 'for', 'slug')
            ->assertSeeIn('@slug_label', __('Slug'))
            ->assertVisible('@slug')
            ->assertAttribute('@slug', 'maxlength', 255)
            ->assertAttribute('@slug', 'name', 'slug')
            ->assertAttribute('@slug', 'pattern', "[a-zA-Z0-9_\-]+")
            ->assertAttribute('@slug', 'required', true)
            ->assertAttribute('@slug', 'type', 'text')
            ->assertAttribute('@slug', 'wire:model.delay', 'slug')
            ->assertAttributeContains('@slug', 'class', 'lowercase');
    }

    public function assertUrl(): void
    {
        $this->browser->assertVisible('@url_label')
            ->assertAttribute('@url_label', 'for', 'url')
            ->assertSeeIn('@url_label', __('URL'))
            ->assertVisible('@url')
            ->assertAttribute('@url', 'readonly', true)
            ->assertAttribute('@url', 'type', 'text')
            ->assertAttribute('@url', 'wire:model.delay', 'url')
            ->assertAttributeContains('@slug', 'class', 'lowercase');
    }

    public function assertSlugAndUrlAfterTypeName(): void
    {
        $this->name = fake()->name();
        $this->slug = str()->of($this->name)->slug();

        $this->browser->type('@name', $this->name)
            ->pause(500)
            ->assertValue('@slug', $this->slug)
            ->assertValue('@url', route('job-seekers.match', ['slug' => $this->slug]));
    }

    public function assertUrlAfterTypeSlug(): void
    {
        $this->slug = fake()->slug();

        $this->browser->type('@slug', $this->slug)
            ->pause(500)
            ->assertValue('@url', route('job-seekers.match', ['slug' => $this->slug]));
    }

    public function assertSlugWithTimeIfExists(): void
    {
        $this->jobSeeker = JobSeeker::factory()->create();

        $this->browser->type('@name', $this->jobSeeker->name)
            ->pause(500)
            ->assertValueIsNot(
                '@slug',
                str()->of($this->jobSeeker->name)->slug()
            );
    }

    public function assertContract(): void
    {
        $this->browser->assertVisible('@contract_id_label')
            ->assertAttribute('@contract_id_label', 'for', 'contract_id')
            ->assertSeeIn('@contract_id_label', __('Contrato'))
            ->assertVisible('@contract_id')
            ->assertAttribute('@contract_id', 'name', 'contract_id')
            ->assertAttribute('@contract_id', 'required', true)
            ->assertSelected('@contract_id', '01H0K7HJTN82AYK1FRADW0P283');
    }

    public function assertCurrency(): void
    {
        $this->browser->assertVisible('@currency_id_label')
            ->assertAttribute('@currency_id_label', 'for', 'currency_id')
            ->assertSeeIn('@currency_id_label', __('Moeda'))
            ->assertVisible('@currency_id')
            ->assertAttribute('@currency_id', 'name', 'currency_id')
            ->assertAttribute('@currency_id', 'required', true)
            ->assertSelected('@currency_id', '01H0K88685BR21KWWR72ARQDJK');
    }

    public function assertSalary(): void
    {
        $this->browser->assertVisible('@salary_label')
            ->assertAttribute('@salary_label', 'for', 'salary')
            ->assertSeeIn('@salary_label', __('Pretensão salarial'))
            ->assertAttribute('@salary', 'min', 1)
            ->assertAttribute('@salary', 'max', 16777215)
            ->assertAttribute('@salary', 'name', 'salary')
            ->assertAttribute('@salary', 'required', true)
            ->assertAttribute('@salary', 'type', 'number');
    }
}
