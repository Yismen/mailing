<?php

namespace Dainsys\Report\Feature\Http\Livewire\Mailable;

use Livewire\Livewire;
use Dainsys\Report\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\Report\Http\Livewire\Mailable\Index;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mailables_index_route_requires_authentication()
    {
        $response = $this->get(route('report.admin.mailables.index'));

        $response->assertRedirect(route('login'));
    }

    // /** @test */
    // public function mailables_index_route_requires_authorization()
    // {
    //     $this->withoutAuthorizedUser();

    //     $response = $this->get(route('report.admin.mailables.index'));

    //     $response->assertForbidden();
    // }

    /** @test */
    public function mailables_index_route_exists()
    {
        $this->withAuthorizedUser();

        $response = $this->get(route('report.admin.mailables.index'));

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

        $component->assertViewIs('report::livewire.mailable.index');
    }
}
