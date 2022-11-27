<?php

namespace Dainsys\Report\Feature\Http\Livewire\Mailable;

use Livewire\Livewire;
use Dainsys\Report\Models\Mailable;
use Dainsys\Report\Tests\TestCase;
use Dainsys\Report\Http\Livewire\Mailable\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function mailable_form_requires_authorization_to_create()
    {
        $mailable = Mailable::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createMailable', $mailable->id);

        $component->assertForbidden();
    }

    /** @test */
    public function mailable_form_requires_authorization_to_update()
    {
        $mailable = Mailable::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateMailable', $mailable->id);

        $component->assertForbidden();
    }

    /** @test */
    public function mailable_index_component_responds_to_wants_create_mailable_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createMailable');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showMailableFormModal');
    }

    /** @test */
    public function mailable_index_component_responds_to_wants_edit_mailable_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateMailable');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showMailableFormModal');
    }

    /** @test */
    public function mailable_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Mailable', 'description' => 'new description'];
        $component = Livewire::test(Form::class)
            ->set('mailable', new Mailable($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('mailableUpdated');

        $this->assertDatabaseHas(reportTableName('mailables'), $data);
    }

    /** @test */
    public function mailable_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $mailable = Mailable::factory()->create(['name' => 'New Mailable', 'description' => 'New description']);
        $component = Livewire::test(Form::class)
            ->set('mailable', $mailable)
            ->set('mailable.name', 'Updated Mailable')
            ->set('mailable.description', 'Updated description');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('mailableUpdated');
        $this->assertDatabaseHas(reportTableName('mailables'), ['name' => 'Updated Mailable', 'description' => 'Updated description']);
    }

    /** @test */
    public function mailable_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('mailable', new Mailable($data));

        $component->call('store');
        $component->assertHasErrors(['mailable.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['mailable.name' => 'required']);
    }

    /** @test */
    public function mailable_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $mailable = Mailable::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('mailable.name', $mailable->name);

        $component->call('store');
        $component->assertHasErrors(['mailable.name' => 'unique']);

        $component->set('mailable', $mailable)->call('update');
        $component->assertHasNoErrors(['mailable.name' => 'unique']);
    }
}
