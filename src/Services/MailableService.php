<?php

namespace Dainsys\Mailing\Services;

use Dainsys\Mailing\Models\Mailable;
use Illuminate\Support\Facades\Cache;

class MailableService implements ServicesContract
{
    public static function list()
    {
        return Cache::rememberForever('mailables_list', function () {
            return Mailable::orderBy('name')->pluck('name', 'id');
        });
    }

    public static function count(): int
    {
        return Cache::rememberForever('mailables_count', function () {
            return Mailable::count();
        });
    }
}
