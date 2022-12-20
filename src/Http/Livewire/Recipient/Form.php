<?php

namespace Dainsys\Mailing\Http\Livewire\Recipient;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\Mailing\Models\Recipient;
use Dainsys\Mailing\Services\MailableService;
use Dainsys\Mailing\Traits\WithRealTimeValidation;
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
    public $mailables = [];

    public $recipient;

    public function render()
    {
        return view('mailing::livewire.recipient.form', [
            'mailables_list' => MailableService::list()
        ])
        ->layout('mailing::layouts.app');
    }

    public function createRecipient($recipient = null)
    {
        $this->recipient = new Recipient(['name' => $recipient]);
        $this->recipient->load(['mailables']);
        $this->authorize('create', $this->recipient);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateRecipient(Recipient $recipient)
    {
        $this->recipient = $recipient->load(['mailables']);
        $this->mailables = $recipient->mailables->pluck('id')->toArray();
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
        $this->recipient->mailables()->sync((array)$this->mailables);

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('recipientUpdated');

        flashMessage('Recipient created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->recipient);
        $this->validate();

        $this->recipient->save();
        $this->recipient->mailables()->sync((array)$this->mailables);

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Recipient Updated!', 'warning');

        $this->editing = false;

        $this->emit('recipientUpdated');
    }

    protected function getRules()
    {
        return [
            'recipient.name' => [
                'required',
                Rule::unique(mailingTableName('recipients'), 'name')->ignore($this->recipient->id ?? 0)
            ],
            'recipient.email' => [
                'required',
                Rule::unique(mailingTableName('recipients'), 'email')->ignore($this->recipient->id ?? 0)
            ],
            'recipient.title' => [
                'nullable',
                'max:100'
            ],
            'mailables' => [
                'nullable',
                'array',
            ]
        ];
    }
}
