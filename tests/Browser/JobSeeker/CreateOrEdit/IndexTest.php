<?php

namespace Tests\Browser\JobSeeker\CreateOrEdit;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IndexTest extends DuskTestCase
{
    const CONTRACT = 'contract_id';

    const CURRENCY = 'currency_id';

    const DUSK_CONTRACT = '@contract_id';

    const DUSK_CURRENCY = '@currency_id';

    const LOGO = '@logo';

    public function testIndex(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertTitle(config('app.name').' - '.
                    __('Dê o match da sua pretensão salarial antes de iniciar o processo seletivo')
                )
                ->assertVisible(self::LOGO)
                ->assertAttribute(self::LOGO, 'alt', config('app.name'))
                ->assertAttributeContains(self::LOGO, 'src', '/resources/images/logo.png')
                ->assertSee(__('Preencha os dados abaixo, receba um link para compartilhar com as empresas, e saiba antes de iniciar o processo seletivo se o salário ofertado é compatível com a sua pretensão salarial.'))
                ->assertVisible(self::DUSK_CONTRACT)
                ->assertAttribute(self::DUSK_CONTRACT, 'id', self::CONTRACT)
                ->assertAttribute(self::DUSK_CONTRACT, 'name', self::CONTRACT)
                ->assertAttribute(self::DUSK_CONTRACT, 'required', true)
                ->assertSelected(self::DUSK_CONTRACT, '01H0K7HJTN82AYK1FRADW0P283')
                ->assertVisible(self::DUSK_CURRENCY)
                ->assertAttribute(self::DUSK_CURRENCY, 'id', self::CURRENCY)
                ->assertAttribute(self::DUSK_CURRENCY, 'name', self::CURRENCY)
                ->assertAttribute(self::DUSK_CURRENCY, 'required', true)
                ->assertSelected(self::DUSK_CURRENCY, '01H0K88685BR21KWWR72ARQDJK');
        });
    }
}
