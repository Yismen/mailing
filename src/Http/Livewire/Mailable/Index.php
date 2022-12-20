<?php

namespace Dainsys\Mailing\Http\Livewire\Mailable;

use Livewire\Component;
use Dainsys\Mailing\Models\Mailable;
use Dainsys\Mailing\Services\MailableService;
use Dainsys\Mailing\Services\MailableFilesService;
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

        return view('mailing::livewire.mailable.index', [
            'mailable_files' => MailableFilesService::list(),
            'mailables' => MailableService::list(),
        ])
        ->layout('mailing::layouts.app');
    }
}
