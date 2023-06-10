<?php

namespace Tests\Browser\JobSeeker;

use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\JobSeeker\Create;
use Tests\DuskTestCase;

class CreateTest extends DuskTestCase
{
    use DatabaseTruncation;

    protected $tablesToTruncate = ['job_seekers'];

    public function testCreate(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new Create);
        });
    }
}
