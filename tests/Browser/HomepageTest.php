<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class HomepageTest extends DuskTestCase
{
    public function testHomepage(): void
    {
        $this->browse(function (Browser $browser) {
            $appName = config('app.name');
            $logo = '@logo';

            $browser->visit('/')
                ->assertTitle($appName . ' - ' .
                    _('Dê o match da sua pretensão salarial antes de iniciar o processo seletivo')
                )
                ->assertVisible($logo)
                ->assertAttribute($logo, 'alt', $appName)
                ->assertAttributeContains($logo, 'src', '/resources/images/logo.png')
                ->assertSee(_('Preencha os dados abaixo, receba um link para compartilhar com as empresas, e saiba antes de iniciar o processo seletivo se o salário ofertado é compatível com a sua pretensão salarial.'));
        });
    }
}
