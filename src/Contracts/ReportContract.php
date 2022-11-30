<?php

namespace Dainsys\Report\Contracts;

interface ReportContract
{
    public static function bind(string $path): void;
}
