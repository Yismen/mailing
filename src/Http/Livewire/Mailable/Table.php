<?php

namespace Dainsys\Report\Http\Livewire\Mailable;

use Dainsys\Report\Models\Mailable;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\Report\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Mailable';

    protected $listeners = [
        'mailableUpdated' => '$refresh',
        'informationUpdated' => '$refresh',
    ];

    public function builder(): Builder
    {
        return Mailable::query()
            // ->with(['information'])
            // ->withCount([
            //     'employees',
            // ])
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Description')
                ->searchable()
                ->format(fn ($value) => str($value ?? '')->limit(30)),
            // Column::make('Recipients', 'id')
            //     ->format(fn ($value, $row) => view('report::tables.badge')->with(['value' => $row->employees_count])),
            Column::make('Actions', 'id')
                ->view('report::tables.actions'),
        ];
    }
}
