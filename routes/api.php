<?php

use Dainsys\Mailing\Models\Form;
use Dainsys\Mailing\Models\Entry;
use Dainsys\Mailing\Models\Response;
use Illuminate\Support\Facades\Route;
use Dainsys\Mailing\Http\Resources\FormResource;
use Dainsys\Mailing\Http\Resources\EntryResource;

Route::middleware(['api'])->group(function () {
    // Auth Routes
    Route::as('dainsys.mailing.api.')
        ->prefix('dainsys/mailing/api')
        ->middleware(
            preg_split('/[,|]+/', config('mailing.midlewares.api'), -1, PREG_SPLIT_NO_EMPTY)
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
