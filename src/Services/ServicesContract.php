<?php

namespace Dainsys\Mailing\Services;

interface ServicesContract
{
    public static function list();

    public static function count(): int;
}
