<?php

namespace Dainsys\Report\Models;

use Dainsys\Report\Database\Factories\MailableFactory;

class Mailable extends AbstractModel
{
    protected $fillable = ['name', 'description'];

    protected static function newFactory(): MailableFactory
    {
        return MailableFactory::new();
    }
}
