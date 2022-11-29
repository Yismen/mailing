<?php

namespace Dainsys\Report\Models;

use Dainsys\Report\Database\Factories\RecipientFactory;
use Dainsys\Report\Models\Traits\BelongsToManyMailables;

class Recipient extends AbstractModel
{
    use BelongsToManyMailables;

    protected $fillable = ['name', 'email', 'title'];

    protected static function newFactory(): RecipientFactory
    {
        return RecipientFactory::new();
    }
}
