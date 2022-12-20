<?php

namespace Dainsys\Mailing\Models\Traits;

use Dainsys\Mailing\Models\Recipient;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyRecipients
{
    public function recipients(): BelongsToMany
    {
        return $this->belongsToMany(Recipient::class, mailingTableName('mailable_recipient'));
    }
}
