<?php

namespace Dainsys\Report\Http\Livewire\Mailable;

use Livewire\Component;
use Illuminate\Validation\Rule;
use Dainsys\Report\Models\Mailable;
use Dainsys\Report\Traits\WithRealTimeValidation;
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

    protected function getRules()
    {
        return [
            'mailable.name' => [
                'required',
                Rule::unique(reportTableName('mailables'), 'name')->ignore($this->mailable->id ?? 0)
            ],
            'mailable.description' => [
                'nullable'
            ]
        ];
    }

    public function render()
    {
        return view('report::livewire.mailable.form', [
        ])
        ->layout('report::layouts.app');
    }

    public function createMailable()
    {
        $this->mailable = new Mailable();
        $this->authorize('create', $this->mailable);
        $this->editing = false;

        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_form);
    }

    public function updateMailable(Mailable $mailable)
    {
        $this->mailable = $mailable;
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

        $this->dispatchBrowserEvent('closeAllModals');

        $this->emit('mailableUpdated');

        flashMessage('Mailable created!', 'success');
    }

    public function update()
    {
        $this->authorize('update', $this->mailable);
        $this->validate();

        $this->mailable->save();

        $this->dispatchBrowserEvent('closeAllModals');

        flashMessage('Mailable Updated!', 'warning');

        $this->editing = false;

        $this->emit('mailableUpdated');
    }
}
