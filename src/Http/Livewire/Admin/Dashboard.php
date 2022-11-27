<?php

namespace Dainsys\Report\Http\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('report::livewire.dashboard', [
        ])
            ->layout(config('report.layout'));
    }
}
