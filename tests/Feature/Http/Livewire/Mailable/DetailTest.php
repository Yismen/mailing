<?php

namespace Dainsys\Report\Feature\Http\Livewire\Mailable;

use Livewire\Livewire;
use Dainsys\Report\Models\Mailable;
use Dainsys\Report\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Dainsys\Report\Http\Livewire\Mailable\Detail;

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
