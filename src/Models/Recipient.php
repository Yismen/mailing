<?php

namespace Dainsys\Report\Models;

use Dainsys\Report\Database\Factories\RecipientFactory;

class Recipient extends AbstractModel
{
    protected $fillable = ['name', 'email', 'title'];

    protected static function newFactory(): RecipientFactory
    {
        return RecipientFactory::new();
    }
}
