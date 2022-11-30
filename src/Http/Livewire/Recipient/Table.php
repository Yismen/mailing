<?php

namespace Dainsys\Report\Http\Livewire\Recipient;

use Dainsys\Report\Models\Recipient;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\Report\Http\Livewire\AbstractDataTableComponent;

class Table extends AbstractDataTableComponent
{
    protected string $module = 'Recipient';

    protected $listeners = [
        'recipientUpdated' => '$refresh',
        'informationUpdated' => '$refresh',
    ];

    public function builder(): Builder
    {
        return Recipient::query()
            ->withCount([
                'mailables',
            ])
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            Column::make('Email')
                ->sortable()
                ->searchable(),
            Column::make('Title')
                ->sortable()
                ->searchable(),
            Column::make('Mailables', 'id')
                ->format(fn ($value, $row) => view('report::tables.badge')->with(['value' => $row->mailables_count])),
            Column::make('Actions', 'id')
                ->view('report::tables.actions'),
        ];
    }
}