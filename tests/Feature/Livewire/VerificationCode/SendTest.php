<?php

namespace Tests\Feature\Livewire\VerificationCode;

use App\Http\Livewire\VerificationCode\Send;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SendTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Send::class);

        $component->assertStatus(200);
    }
}
