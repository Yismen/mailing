<?php

namespace Dainsys\Report\Http\Livewire\Mailable;

use Livewire\Component;
use Dainsys\Report\Models\Mailable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Index extends Component
{
    use AuthorizesRequests;

    public function render()
    {
        $this->authorize('viewAny', new Mailable());

        return view('report::livewire.mailable.index', [
        ])
        ->layout('report::layouts.app');
    }
}
