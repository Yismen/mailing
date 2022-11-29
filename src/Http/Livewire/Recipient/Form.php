<?php

namespace Dainsys\Report\Http\Livewire\Recipient;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\Report\Models\Recipient;
use Dainsys\Report\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    protected $listeners = [
        'createRecipient',
        'updateRecipient',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showRecipientFormModal';

    public $recipient;

    protected function getRules()
    {
        return [
            'recipient.name' => [
                'required',
                Rule::unique(reportTableName('recipients'), 'name')->ignore($this->recipient->id ?? 0)
            ],
            'recipient.email' => [
                'required',
                Rule::unique(reportTableName('recipients'), 'email')->ignore($this->recipient->id ?? 0)
            ],
            'recipient.title' => [
                'nullable',
                'max:100'
            ]
        ];
    }

    public function render()
    {
        return view('report::livewire.recipient.form', [
        ])
        ->layout('report::layouts.app');
    }

    public function createRecipient($recipient = null)
    {
        $this->recipient = new Recipient(['name' => $recipient]);
        $this->authorize('create', $this->recipient);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateRecipient(Recipient $recipient)
    {
        $this->recipient = $recipient;
        $this->authorize('update', $this->recipient);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Recipient());
        $this->validate();

        $this->editing = false;

        $this->recipient->save();

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('recipientUpdated');

        flashMessage('Recipient created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->recipient);
        $this->validate();

        $this->recipient->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Recipient Updated!', 'warning');

        $this->editing = false;

        $this->emit('recipientUpdated');
    }
}
