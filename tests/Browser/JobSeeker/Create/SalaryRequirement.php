<?php

namespace Tests\Browser\JobSeeker\Create;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SalaryRequirement extends DuskTestCase
{
    public function testSalaryRequirement(): void
    {
        $this->browse(function (Browser $browser) {
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
                    ->assertSelected(self::DUSK_CURRENCY, '01H0K88685BR21KWWR72ARQDJK');
        });
    }
}
