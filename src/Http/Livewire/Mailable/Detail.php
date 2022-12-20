<?php

namespace Dainsys\Mailing\Http\Livewire\Mailable;

use Livewire\Component;
use Dainsys\Mailing\Models\Mailable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Detail extends Component
{
    use AuthorizesRequests;

    protected $listeners = [
        'showMailable',
    ];

    public bool $editing = false;
    public string $modal_event_name_detail = 'showMailableDetailModal';

    public $mailable;

    public function render()
    {
        return view('mailing::livewire.mailable.detail', [
        ])
        ->layout('mailing::layouts.app');
    }

    public function showMailable(Mailable $mailable)
    {
        $this->authorize('view', $mailable);

        $this->editing = false;
        $this->mailable = $mailable;
        $this->resetValidation();

        $this->dispatchBrowserEvent('closeAllModals');
        $this->dispatchBrowserEvent($this->modal_event_name_detail);
    }
}
