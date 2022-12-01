<?php

namespace Dainsys\Report;

use Illuminate\Mail\Mailable;
use Dainsys\Report\Contracts\ReportContract;
use Dainsys\Report\Models\Mailable as ModelsMailable;

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

    public static function recipients(Mailable $mail): array
    {
        $class_name = get_class($mail);
        $report = ModelsMailable::query()
            ->where('name', $class_name)
            ->with(['recipients'])
            ->first();

        return $report
            ? $report->recipients->pluck('email', 'name')->all()
            : [];
    }
}
