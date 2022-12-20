<?php

namespace Dainsys\Mailing\Http\Livewire\Mailable;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\Mailing\Models\Mailable;
use Dainsys\Mailing\Services\RecipientService;
use Dainsys\Mailing\Traits\WithRealTimeValidation;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Form extends Component
{
    use AuthorizesRequests;
    use WithRealTimeValidation;

    protected $listeners = [
        'createMailable',
        'updateMailable',
    ];

    public bool $editing = false;
    public string $modal_event_name_form = 'showMailableFormModal';

    public $mailable;
    public $recipients = [];

    public function render()
    {
        return view('mailing::livewire.mailable.form', [
            'recipients_list' => RecipientService::list()->all()
        ])
        ->layout('mailing::layouts.app');
    }

    public function createMailable($mailable = null)
    {
        $this->mailable = new Mailable(['name' => $mailable, 'active' => true]);
        $this->mailable->load(['recipients']);
        $this->recipients = [];
        $this->authorize('create', $this->mailable);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateMailable(Mailable $mailable)
    {
        $this->mailable = $mailable->load(['recipients']);
        $this->recipients = $mailable->recipients->pluck('id')->toArray();
        $this->authorize('update', $this->mailable);
        $this->editing = true;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function store()
    {
        $this->authorize('create', new Mailable());
        $this->validate();

        $this->editing = false;

        $this->mailable->save();
        $this->mailable->recipients()->sync((array)$this->recipients);

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('mailableUpdated');

        flashMessage('Mailable created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->mailable);
        $this->validate();

        $this->mailable->save();
        $this->mailable->recipients()->sync((array)$this->recipients);

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Mailable Updated!', 'warning');

        $this->editing = false;

        $this->emit('mailableUpdated');
    }

    protected function getRules()
    {
        return [
            'mailable.name' => [
                'required',
                Rule::unique(mailingTableName('mailables'), 'name')->ignore($this->mailable->id ?? 0)
            ],
            'mailable.description' => [
                'nullable'
            ],
            'mailable.active' => [
                'nullable',
                'boolean'
            ],
            'recipients' => [
                'nullable',
                'array',
            ]
        ];
    }
}
