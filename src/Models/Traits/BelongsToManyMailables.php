<?php

namespace Dainsys\Mailing\Models\Traits;

use Dainsys\Mailing\Models\Mailable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyMailables
{
    public function mailables(): BelongsToMany
    {
        return $this->belongsToMany(Mailable::class, mailingTableName('mailable_recipient'));
    }
}
