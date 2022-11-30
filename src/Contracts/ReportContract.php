<?php

namespace Dainsys\Report\Contracts;

use Illuminate\Mail\Mailable;

interface ReportContract
{
    public static function bind(string $path): void;

    public static function recipients(Mailable $mail): array;
}
