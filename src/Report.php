<?php

namespace Dainsys\Report;

use Dainsys\Report\Contracts\ReportContract;

class Report implements ReportContract
{
    public static function bind(string $path): void
    {
        $config = app('config');
        $items = $config->get('report.mailables_dirs');

        if (!in_array($path, $items)) {
            app('config')->prepend('report.mailables_dirs', $path);
        }
    }
}
