<?php

namespace Tests\Browser\JobSeeker\Create;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateTest extends DuskTestCase
{
    const CONTRACT = 'contract_id';

    const CURRENCY = 'currency_id';

    const DUSK_CONTRACT = '@contract_id';

    const DUSK_CONTRACT_LABEL = '@contract_id_label';

    const DUSK_CURRENCY = '@currency_id';

    const DUSK_CURRENCY_LABEL = '@currency_id_label';

    const LOGO = '@logo';

    public function testCreate(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertTitle(config('app.name').' - '.
                    __('Dê o match da sua pretensão salarial antes de iniciar o processo seletivo')
                )
                ->assertVisible(self::LOGO)
                ->assertAttribute(self::LOGO, 'alt', config('app.name'))
                ->assertAttributeContains(self::LOGO, 'src', '/resources/images/logo.png')
                ->assertSee(__('Preencha os dados abaixo, receba um link para compartilhar com as empresas, e saiba antes de iniciar o processo seletivo se o salário ofertado é compatível com a sua pretensão salarial.'));
        });
    }
}
