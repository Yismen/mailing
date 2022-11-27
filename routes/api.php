<?php

use Dainsys\Report\Models\Form;
use Dainsys\Report\Models\Entry;
use Dainsys\Report\Models\Response;
use Illuminate\Support\Facades\Route;
use Dainsys\Report\Http\Resources\FormResource;
use Dainsys\Report\Http\Resources\EntryResource;

Route::middleware(['api'])->group(function () {
    // Auth Routes
    Route::as('dainsys.report.api.')
        ->prefix('dainsys/report/api')
        ->middleware(
            preg_split('/[,|]+/', config('report.midlewares.api'), -1, PREG_SPLIT_NO_EMPTY)
        )->group(function () {
            // Route::get('form/{form}', function ($form) {
            //     return new FormResource(Form::with('responses')->find($form));
            // })->name('form.show');
            // Route::get('entries/{entry}', function ($entry) {
            //     return new EntryResource(Entry::with('form', 'responses')->findOrFail($entry));
            // })->name('entries.show');
            // Route::get('responses/entry/{entry}', ['data' => 'response by entry'])->name('responses.entry.show');
        });
});
