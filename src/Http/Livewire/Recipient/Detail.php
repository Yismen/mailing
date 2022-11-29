<?php

namespace Dainsys\Report\Http\Livewire\Recipient;

use Livewire\Component;
use Dainsys\Report\Models\Recipient;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showRecipient',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showRecipientDetailModal';

    public $recipient;

    public function render()
    {
        return view('report::livewire.recipient.detail', [
        ])
        ->layout('report::layouts.app');
    }

    public function showRecipient(Recipient $recipient)
    {
        $this->authorize('view', $recipient);

        $this->editing = false;
        $this->recipient = $recipient;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
