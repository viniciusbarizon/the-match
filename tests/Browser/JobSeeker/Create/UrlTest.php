<?php

namespace Tests\Browser\JobSeeker\Create;

use App\Models\JobSeeker;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UrlTest extends DuskTestCase
{
    const DUSK_NAME = '@name';

    const DUSK_SLUG = '@slug';

    const DUSK_URL = '@url';

    const MAX_LENGTH = 255;

    const NAME = 'name';

    const SLUG = 'slug';

    const URL = 'url';

    private string $name;

    private string $slug;

    public function testSlugDoesNotExist(): void
    {
        $this->setFakeName();
        $this->setSlug();

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee(__('Nome'))
                ->assertVisible(self::DUSK_NAME)
                ->assertAttribute(self::DUSK_NAME, 'autocomplete', 'name')
                ->assertAttribute(self::DUSK_NAME, 'maxlength', self::MAX_LENGTH)
                ->assertAttribute(self::DUSK_NAME, 'name', self::NAME)
                ->assertAttribute(self::DUSK_NAME, 'required', true)
                ->assertAttribute(self::DUSK_NAME, 'type', 'text')
                ->assertAttribute(self::DUSK_NAME, 'wire:model.delay', self::NAME)
                ->assertSee(__('Slug'))
                ->assertVisible(self::DUSK_SLUG)
                ->assertAttribute(self::DUSK_SLUG, 'maxlength', self::MAX_LENGTH)
                ->assertAttribute(self::DUSK_SLUG, 'name', self::SLUG)
                ->assertAttribute(self::DUSK_SLUG, 'required', true)
                ->assertAttribute(self::DUSK_SLUG, 'type', 'text')
                ->assertAttribute(self::DUSK_SLUG, 'wire:model.delay', self::SLUG)
                ->assertSee(__('URL'))
                ->assertVisible(self::DUSK_URL)
                ->assertAttribute(self::DUSK_URL, 'readonly', true)
                ->assertAttribute(self::DUSK_URL, 'type', 'text')
                ->assertAttribute(self::DUSK_URL, 'wire:model.defer', self::URL)
                ->type(self::DUSK_NAME, $this->name)
                ->pause(1000)
                ->assertValue(self::DUSK_SLUG, $this->slug)
                ->assertValue(self::DUSK_URL, route('job-seekers.match', ['slug' => $this->slug]))
                ->append(self::DUSK_SLUG, 'x')
                ->pause(1000)
                ->assertValue(self::DUSK_URL, route('job-seekers.match', ['slug' => $this->slug.'x']));
        });
    }

    public function testSlugExists(): void
    {
        $jobSeeker = JobSeeker::factory()->create();
        $this->name = $jobSeeker->name;
        $this->setSlug();

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->type(self::DUSK_NAME, $this->name)
                ->pause(500)
                ->assertValue(self::DUSK_SLUG, $this->slug.'-'.time());
        });
    }

    private function setFakeName(): void
    {
        $this->name = fake()->name();
    }

    private function setSlug(): void
    {
        $this->slug = str()->of($this->name)->slug();
    }
}
