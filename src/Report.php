<?php

namespace Dainsys\Report;

use Illuminate\Mail\Mailable;
use Dainsys\Report\Contracts\ReportContract;
use Dainsys\Report\Models\Mailable as ModelsMailable;
use Dainsys\Report\Exceptions\MailableNotFoundException;
use Dainsys\Report\Exceptions\MailableNotActiveException;
use Dainsys\Report\Exceptions\MailableWithoutRecipientsException;

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

        if (!$report) {
            throw new MailableNotFoundException("Unable to find a record for report {$class_name}. Did you added it to the mailables table in route /report/admin/mailables?", 404);
        }

        if (!$report->active) {
            throw new MailableNotActiveException("Mailable {$class_name} is inactive, therefore should not be receiving emails.", 419);
        }

        if ($report->recipients->count() === 0) {
            throw new MailableWithoutRecipientsException("There is no recipients assigned to report {$class_name} so no one to send email to. Please assign some in route /report/admin/mailables!", 405);
        }

        return  $report->recipients->pluck('email', 'name')->all();
    }
}
