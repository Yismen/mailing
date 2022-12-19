<?php

namespace Dainsys\Report\Http\Livewire;

use Livewire\Component;
use Dainsys\Report\Services\MailableService;
use Dainsys\Report\Services\RecipientService;
use Dainsys\Report\Services\MailableFilesService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Dashboard extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        return view('report::livewire.dashboard', [
            'mailables' => MailableFilesService::count(),
            'registered' => MailableService::count(),
            'recipients' => RecipientService::count(),
        ])
        ->layout('report::layouts.app');
    }
}
