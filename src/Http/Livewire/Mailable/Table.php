<?php

namespace Dainsys\Report\Http\Livewire\Mailable;

use Dainsys\Report\Models\Mailable;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Dainsys\Report\Http\Livewire\AbstractDataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

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
            ->withCount([
                'recipients',
            ])
            ;
    }

    public function columns(): array
    {
        return [
            Column::make('Name')
                ->sortable()
                ->searchable(),
            BooleanColumn::make('Active'),
            Column::make('Description')
                ->searchable()
                ->format(fn ($value, $row) => $row->short_description),
            Column::make('Recipients', 'id')
                ->format(fn ($value, $row) => view('report::tables.badge')->with(['value' => $row->recipients_count])),
            Column::make('Actions', 'id')
                ->view('report::tables.actions'),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options([
                    '' => 'All',
                    '1' => 'Active',
                    '0' => 'Inactive',
                ])
                ->filter(function (Builder $builder, string $value) {
                    if ($value === '1') {
                        $builder->where('active', true);
                    } elseif ($value === '0') {
                        $builder->where('active', false);
                    }
                })
        ];
    }
}
