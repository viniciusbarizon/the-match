<?php

namespace Tests\Browser\JobSeeker\Create;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SalaryRequirementTest extends DuskTestCase
{
    const AMOUNT = 'amount';

    const CONTRACT = 'contract_id';

    const CURRENCY = 'currency_id';

    const DUSK_AMOUNT = '@'.self::AMOUNT;

    const DUSK_AMOUNT_LABEL = self::DUSK_AMOUNT.'_label';

    const DUSK_CONTRACT = '@'.self::CONTRACT;

    const DUSK_CONTRACT_LABEL = self::DUSK_CONTRACT.'_label';

    const DUSK_CURRENCY = '@'.self::CURRENCY;

    const DUSK_CURRENCY_LABEL = self::DUSK_CURRENCY.'_label';

    public function testSalaryRequirement(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertVisible(self::DUSK_CONTRACT_LABEL)
                ->assertAttribute(self::DUSK_CONTRACT_LABEL, 'for', self::CONTRACT)
                ->assertSeeIn(self::DUSK_CONTRACT_LABEL, __('Contrato'))
                ->assertVisible(self::DUSK_CONTRACT)
                ->assertAttribute(self::DUSK_CONTRACT, 'id', self::CONTRACT)
                ->assertAttribute(self::DUSK_CONTRACT, 'name', self::CONTRACT)
                ->assertAttribute(self::DUSK_CONTRACT, 'required', true)
                ->assertSelected(self::DUSK_CONTRACT, '01H0K7HJTN82AYK1FRADW0P283')
                ->assertVisible(self::DUSK_CURRENCY_LABEL)
                ->assertAttribute(self::DUSK_CURRENCY_LABEL, 'for', self::CURRENCY)
                ->assertSeeIn(self::DUSK_CURRENCY_LABEL, __('Moeda'))
                ->assertVisible(self::DUSK_CURRENCY)
                ->assertAttribute(self::DUSK_CURRENCY, 'id', self::CURRENCY)
                ->assertAttribute(self::DUSK_CURRENCY, 'name', self::CURRENCY)
                ->assertAttribute(self::DUSK_CURRENCY, 'required', true)
                ->assertSelected(self::DUSK_CURRENCY, '01H0K88685BR21KWWR72ARQDJK')
                ->assertAttribute(self::DUSK_AMOUNT_LABEL, 'for', self::AMOUNT)
                ->assertSeeIn(self::DUSK_AMOUNT_LABEL, __('Pretensão salarial'))
                ->assertVisible(self::DUSK_AMOUNT)
                ->assertAttribute(self::DUSK_AMOUNT, 'id', self::AMOUNT)
                ->assertAttribute(self::DUSK_AMOUNT, 'min', 1)
                ->assertAttribute(self::DUSK_AMOUNT, 'max', 16777215)
                ->assertAttribute(self::DUSK_AMOUNT, 'name', self::AMOUNT)
                ->assertAttribute(self::DUSK_AMOUNT, 'required', true)
                ->assertAttribute(self::DUSK_AMOUNT, 'type', 'number');
        });
    }
}
