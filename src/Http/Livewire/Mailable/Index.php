<?php

namespace Dainsys\Report\Http\Livewire\Mailable;

use Livewire\Component;
use Dainsys\Report\Models\Mailable;
use Dainsys\Report\Services\MailableService;
use Dainsys\Report\Services\MailableFilesService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    protected $listeners = [

        'mailableUpdated' => '$refresh',
    ];

    public function render()
    {
        $this->authorize('viewAny', new Mailable());

        return view('report::livewire.mailable.index', [
            'mailable_files' => MailableFilesService::list(),
            'mailables' => MailableService::list(),
        ])
        ->layout('report::layouts.app');
    }
}
