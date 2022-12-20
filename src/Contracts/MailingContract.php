<?php

namespace Dainsys\Mailing\Contracts;

use Illuminate\Mail\Mailable;

interface MailingContract
{
    public static function bind(string $path): void;

    public static function recipients(Mailable $mail): array;
}
