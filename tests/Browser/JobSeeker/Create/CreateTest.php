<?php

namespace Tests\Browser\JobSeeker\Create;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\JobSeeker\Create;
use Tests\DuskTestCase;

class CreateTest extends DuskTestCase
{
    public function testCreate(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Create)
                ->assertCreateTitle()
                ->assertLogo()
                ->assertDescription();
        });
    }
}
