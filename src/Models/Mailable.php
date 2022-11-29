<?php

namespace Dainsys\Report\Models;

use Dainsys\Report\Database\Factories\MailableFactory;
use Dainsys\Report\Models\Traits\BelongsToManyRecipients;

class Mailable extends AbstractModel
{
    use BelongsToManyRecipients;

    protected $fillable = ['name', 'description', 'active'];

    protected static function newFactory(): MailableFactory
    {
        return MailableFactory::new();
    }

    public function getShortDescriptionAttribute()
    {
        return str($this->attributes['description'] ?? '')->limit(25);
    }

    public function scopeActives($query)
    {
        $query->where('active', true);
    }
}
