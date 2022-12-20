<?php

namespace Dainsys\Mailing\Models;

use Dainsys\Mailing\Database\Factories\RecipientFactory;
use Dainsys\Mailing\Models\Traits\BelongsToManyMailables;

class Recipient extends AbstractModel
{
    use BelongsToManyMailables;

    protected $fillable = ['name', 'email', 'title'];

    protected static function newFactory(): RecipientFactory
    {
        return RecipientFactory::new();
    }
}
