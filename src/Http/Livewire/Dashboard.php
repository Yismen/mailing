<?php

namespace Dainsys\Mailing\Http\Livewire;

use Livewire\Component;
use Dainsys\Mailing\Services\MailableService;
use Dainsys\Mailing\Services\RecipientService;
use Dainsys\Mailing\Services\MailableFilesService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Dashboard extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('interact-with-mailing-admin');

        return view('mailing::livewire.dashboard', [
            'mailables' => MailableFilesService::count(),
            'registered' => MailableService::count(),
            'recipients' => RecipientService::count(),
        ])
        ->layout('mailing::layouts.app');
    }
}
