<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    // Guest Routes
    Route::as('report.')
    ->prefix('report')
    ->group(function () {
        Route::get('', \Dainsys\Report\Http\Controllers\AboutController::class)->name('about');
        Route::get('admin', \Dainsys\Report\Http\Controllers\AboutController::class)->name('about');
        Route::get('about', \Dainsys\Report\Http\Controllers\AboutController::class)->name('about');
    });
    // Auth Routes
    Route::as('report.admin.')
        ->prefix(config('report.routes_prefix.admin'))
        ->middleware(
            preg_split('/[,|]+/', config('report.midlewares.web'), -1, PREG_SPLIT_NO_EMPTY)
        )->group(function () {
            Route::get('dashboard', \Dainsys\Report\Http\Livewire\Dashboard::class)->name('dashboard');

            Route::get('mailables', \Dainsys\Report\Http\Livewire\Mailable\Index::class)
                ->name('mailables.index')
                ->can('viewAny', \Dainsys\Report\Models\Mailable::class);

            Route::get('recipients', \Dainsys\Report\Http\Livewire\Recipient\Index::class)
                    ->name('recipients.index')
                    ->can('viewAny', \Dainsys\Report\Models\Recipient::class);
        });
});
