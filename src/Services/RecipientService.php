<?php

namespace Dainsys\Mailing\Services;

use Dainsys\Mailing\Models\Recipient;
use Illuminate\Support\Facades\Cache;

class RecipientService implements ServicesContract
{
    public static function list()
    {
        return Cache::rememberForever('recipients_list', function () {
            return Recipient::orderBy('name')->pluck('name', 'id');
        });
    }

    public static function count(): int
    {
        return Cache::rememberForever('recipients_count', function () {
            return Recipient::count();
        });
    }
}
