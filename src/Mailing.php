<?php

namespace Dainsys\Mailing;

use Illuminate\Mail\Mailable;
use Dainsys\Mailing\Contracts\MailingContract;
use Dainsys\Mailing\Models\Mailable as ModelsMailable;
use Dainsys\Mailing\Exceptions\MailableNotFoundException;
use Dainsys\Mailing\Exceptions\MailableNotActiveException;
use Dainsys\Mailing\Exceptions\MailableWithoutRecipientsException;

class Mailing implements MailingContract
{
    public static function bind(string $path): void
    {
        $config = app('config');
        $items = $config->get('mailing.mailables_dirs');

        if (!in_array($path, $items)) {
            app('config')->prepend('mailing.mailables_dirs', $path);
        }
    }

    /**
     * Return a list of recipients assigned to mailable
     *
     * @param  \Illuminate\Mail\Mailable|string $mail
     * @return array
     */
    public static function recipients($mail): array
    {
        $class_name = $mail instanceof Mailable ? get_class($mail) : $mail;

        $mailing = ModelsMailable::query()
            ->where('name', $class_name)
            ->with(['recipients'])
            ->first();

        if (!$mailing) {
            throw new MailableNotFoundException("Unable to find a record for mailing {$class_name}. Did you added it to the mailables table in route /mailing/admin/mailables?", 404);
        }

        if (!$mailing->active) {
            throw new MailableNotActiveException("Mailable {$class_name} is inactive, therefore should not be receiving emails.", 419);
        }

        if ($mailing->recipients->count() === 0) {
            throw new MailableWithoutRecipientsException("There is no recipients assigned to mailing {$class_name} so no one to send email to. Please assign some in route /mailing/admin/mailables!", 405);
        }

        return  $mailing->recipients->pluck('email', 'name')->all();
    }

    public static function registerSuperUsers(array $emails)
    {
        $current = config('mailing.super_users');

        $new = $current . ',' . join(',', $emails);

        config()->set('mailing.super_users', $new);
    }
}
