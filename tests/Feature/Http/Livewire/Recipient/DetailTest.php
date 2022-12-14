<?php

namespace Dainsys\Mailing\Feature\Http\Livewire\Recipient;

use Livewire\Livewire;
use Dainsys\Mailing\Tests\TestCase;
use Dainsys\Mailing\Models\Recipient;
use Dainsys\Mailing\Http\Livewire\Recipient\Detail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function recipient_detail_requires_authorization()
    {
        $recipient = Recipient::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showRecipient', $recipient->id);

        $component->assertForbidden();
    }

    /** @test */
    public function recipient_index_component_responds_to_wants_show_recipient_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showRecipient');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showRecipientDetailModal');
    }
}
