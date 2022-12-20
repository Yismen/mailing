<?php

namespace Dainsys\Mailing\Http\Livewire\Recipient;

use Livewire\Component;
use Dainsys\Mailing\Models\Recipient;
use Dainsys\Mailing\Services\RecipientService;
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

        return view('mailing::livewire.recipient.index', [
            'recipients' => RecipientService::list()
        ])
        ->layout('mailing::layouts.app');
    }
}
