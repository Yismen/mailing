<?php

namespace Dainsys\Report\Http\Livewire\Recipient;

use Livewire\Component;
use Dainsys\Report\Models\Recipient;
use Dainsys\Report\Services\RecipientService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    protected $listeners = [

        'recipientUpdated' => '$refresh',
    ];

    public function render()
    {
        $this->authorize('viewAny', new Recipient());

        return view('report::livewire.recipient.index', [
            'recipients' => RecipientService::list()
        ])
        ->layout('report::layouts.app');
    }
}
