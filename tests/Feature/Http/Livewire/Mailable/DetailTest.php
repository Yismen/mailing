<?php

namespace Dainsys\Mailing\Feature\Http\Livewire\Mailable;

use Livewire\Livewire;
use Dainsys\Mailing\Models\Mailable;
use Dainsys\Mailing\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\Mailing\Http\Livewire\Mailable\Detail;

class DetailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mailable_detail_requires_authorization()
    {
        $mailable = Mailable::factory()->create();
        $component = Livewire::test(Detail::class)
            ->emit('showMailable', $mailable->id);

        $component->assertForbidden();
    }

    /** @test */
    public function mailable_index_component_responds_to_wants_show_mailable_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Detail::class)
            ->emit('showMailable');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showMailableDetailModal');
    }
}
