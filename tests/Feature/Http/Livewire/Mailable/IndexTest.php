<?php

namespace Dainsys\Mailing\Feature\Http\Livewire\Mailable;

use Livewire\Livewire;
use Dainsys\Mailing\Tests\TestCase;
use Dainsys\Mailing\Http\Livewire\Mailable\Index;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mailables_index_route_requires_authentication()
    {
        $response = $this->get(route('mailing.admin.mailables.index'));

        $response->assertRedirect(route('login'));
    }

    // /** @test */
    // public function mailables_index_route_requires_authorization()
    // {
    //     $this->withoutAuthorizedUser();

    //     $response = $this->get(route('mailing.admin.mailables.index'));

    //     $response->assertForbidden();
    // }

    /** @test */
    public function mailables_index_route_exists()
    {
        $this->withAuthorizedUser();

        $response = $this->get(route('mailing.admin.mailables.index'));

        $response->assertOk();
    }

    /** @test */
    public function mailable_index_component_requires_authorization()
    {
        $component = Livewire::test(Index::class);

        $component->assertForbidden();
    }

    /** @test */
    public function mailable_index_component_renders_properly()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Index::class);

        $component->assertViewIs('mailing::livewire.mailable.index');
    }
}
