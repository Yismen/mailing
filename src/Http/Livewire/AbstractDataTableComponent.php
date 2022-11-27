<?php

namespace Dainsys\Report\Http\Livewire;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

abstract class AbstractDataTableComponent extends DataTableComponent
{
    public function configure(): void
    {
        $records = $this->builder()->getModel()->count();

        $this->withDefaultSorting();

        $this->setPrimaryKey('id');
        $this->setColumnSelectDisabled();
        $this->setQueryStringDisabled();
        $this->setTableAttributes([
            'class' => 'table-sm table-hover',
        ]);

        $this->setConfigurableAreas([
            'before-toolbar' => [
                'report::tables.header', [
                    'module' => $this->module,
                    'count' => $records,
                ],
            ],
        ]);
    }

    /**
     * @return string
     */
    public function getTheme(): string
    {
        return 'bootstrap-4';
    }

    public function applySearch(): Builder
    {
        if ($this->searchIsEnabled() && $this->hasSearch()) {
            $searchableColumns = $this->getSearchableColumns();

            if ($searchableColumns->count()) {
                $this->setBuilder($this->getBuilder()->where(function ($query) use ($searchableColumns) {
                    $searchTerms = preg_split("/[\s]+/", $this->getSearch(), -1, PREG_SPLIT_NO_EMPTY);

                    foreach ($searchTerms as $value) {
                        $query->where(function ($query) use ($searchableColumns, $value) {
                            foreach ($searchableColumns as $index => $column) {
                                if ($column->hasSearchCallback()) {
                                    ($column->getSearchCallback())($query, $this->getSearch());
                                } else {
                                    $query->{$index === 0 ? 'where' : 'orWhere'}($column->getColumn(), 'like', '%' . $value . '%');
                                }
                            }
                        });
                    }
                }));
            }
        }

        return $this->getBuilder();
    }

    protected function withDefaultSorting()
    {
        $this->setDefaultSort('name', 'asc');
    }

//     public function getTitle(): string
//     {
//         dd(str(get_class($this))->beforeLast('\\'));

//         return Str::of(get_class($this))->beforeLast('\\')->afterLast('\\')->plural()->headline()->__toString() . ' ' . Str::of(get_class($this))->afterLast('\\')->headline()->__toString();
//     }
}
