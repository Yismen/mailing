<?php

namespace Dainsys\Report\Services;

interface ServicesContract
{
    public static function list();

    public static function count(): int;
}
