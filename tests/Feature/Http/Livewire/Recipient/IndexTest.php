<?php

namespace Dainsys\Mailing\Feature\Http\Livewire\Recipient;

use Livewire\Livewire;
use Dainsys\Mailing\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\Mailing\Http\Livewire\Recipient\Index;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function recipients_index_route_requires_authentication()
    {
        $response = $this->get(route('mailing.admin.recipients.index'));

        $response->assertRedirect(route('login'));
    }

    // /** @test */
    // public function recipients_index_route_requires_authorization()
    // {
    //     $this->withoutAuthorizedUser();

    //     $response = $this->get(route('mailing.admin.recipients.index'));

    //     $response->assertForbidden();
    // }

    /** @test */
    public function recipients_index_route_exists()
    {
        $this->withAuthorizedUser();

        $response = $this->get(route('mailing.admin.recipients.index'));

        $response->assertOk();
    }

    /** @test */
    public function recipient_index_component_requires_authorization()
    {
        $component = Livewire::test(Index::class);

        $component->assertForbidden();
    }

    /** @test */
    public function recipient_index_component_renders_properly()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Index::class);

        $component->assertViewIs('mailing::livewire.recipient.index');
    }
}
