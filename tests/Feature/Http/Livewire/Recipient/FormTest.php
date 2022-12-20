<?php

namespace Dainsys\Mailing\Feature\Http\Livewire\Recipient;

use Livewire\Livewire;
use Dainsys\Mailing\Tests\TestCase;
use Dainsys\Mailing\Models\Recipient;
use Dainsys\Mailing\Http\Livewire\Recipient\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function recipient_form_requires_authorization_to_create()
    {
        $recipient = Recipient::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('createRecipient', $recipient->id);

        $component->assertForbidden();
    }

    /** @test */
    public function recipient_form_requires_authorization_to_update()
    {
        $recipient = Recipient::factory()->create();
        $component = Livewire::test(Form::class)
            ->emit('updateRecipient', $recipient->id);

        $component->assertForbidden();
    }

    /** @test */
    public function recipient_index_component_responds_to_wants_create_recipient_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('createRecipient');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showRecipientFormModal');
    }

    /** @test */
    public function recipient_index_component_responds_to_wants_edit_recipient_event()
    {
        $this->withAuthorizedUser();
        $component = Livewire::test(Form::class)
            ->emit('updateRecipient');

        $component->assertSet('editing', true);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertDispatchedBrowserEvent('showRecipientFormModal');
    }

    /** @test */
    public function recipient_index_component_create_new_record()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Recipient', 'email' => 'new email'];
        $component = Livewire::test(Form::class)
            ->set('recipient', new Recipient($data));

        $component->call('store');
        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('recipientUpdated');

        $this->assertDatabaseHas(mailingTableName('recipients'), $data);
    }

    /** @test */
    public function recipient_index_component_update_record()
    {
        $this->withAuthorizedUser();
        $recipient = Recipient::factory()->create(['name' => 'New Recipient', 'email' => 'New email']);
        $component = Livewire::test(Form::class)
            ->set('recipient', $recipient)
            ->set('recipient.name', 'Updated Recipient')
            ->set('recipient.email', 'Updated email');

        $component->call('update');

        $component->assertSet('editing', false);
        $component->assertDispatchedBrowserEvent('closeAllModals');
        $component->assertEmitted('recipientUpdated');
        $this->assertDatabaseHas(mailingTableName('recipients'), ['name' => 'Updated Recipient', 'email' => 'Updated email']);
    }

    /** @test */
    public function recipient_index_component_validates_required_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => ''];
        $component = Livewire::test(Form::class)
            ->set('recipient', new Recipient($data));

        $component->call('store');
        $component->assertHasErrors(['recipient.name' => 'required']);

        $component->call('update');
        $component->assertHasErrors(['recipient.name' => 'required']);
    }

    /** @test */
    public function recipient_index_component_validates_unique_fields()
    {
        $this->withAuthorizedUser();
        $data = ['name' => 'New Name'];
        $recipient = Recipient::factory()->create($data);

        $component = Livewire::test(Form::class)
            ->set('recipient.name', $recipient->name);

        $component->call('store');
        $component->assertHasErrors(['recipient.name' => 'unique']);

        $component->set('recipient', $recipient)->call('update');
        $component->assertHasNoErrors(['recipient.name' => 'unique']);
    }
}
