<?php

namespace Tests\Browser\JobSeeker\CreateOrEdit;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IndexTest extends DuskTestCase
{
    const CONTRACT = 'contract';

    const DUSK_CONTRACT = '@contract';

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
                ->assertSelected(self::DUSK_CONTRACT, '01H0K7HJTN82AYK1FRADW0P283');
        });
    }
}
