<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    // Guest Routes
    Route::as('mailing.')
    ->prefix('mailing')
    ->group(function () {
        Route::get('', \Dainsys\Mailing\Http\Controllers\AboutController::class);
        Route::get('admin', \Dainsys\Mailing\Http\Controllers\AboutController::class);
        Route::get('about', \Dainsys\Mailing\Http\Controllers\AboutController::class)->name('about');
    });
    // Auth Routes
    Route::as('mailing.admin.')
        ->prefix(config('mailing.routes_prefix.admin'))
        ->middleware(
            preg_split('/[,|]+/', config('mailing.midlewares.web'), -1, PREG_SPLIT_NO_EMPTY)
        )->group(function () {
            Route::get('dashboard', \Dainsys\Mailing\Http\Livewire\Dashboard::class)->name('dashboard');

            Route::get('mailables', \Dainsys\Mailing\Http\Livewire\Mailable\Index::class)
                ->name('mailables.index')
                ->can('viewAny', \Dainsys\Mailing\Models\Mailable::class);

            Route::get('recipients', \Dainsys\Mailing\Http\Livewire\Recipient\Index::class)
                    ->name('recipients.index')
                    ->can('viewAny', \Dainsys\Mailing\Models\Recipient::class);
        });
});
