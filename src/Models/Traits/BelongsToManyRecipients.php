<?php

namespace Dainsys\Report\Models\Traits;

use Dainsys\Report\Models\Recipient;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyRecipients
{
    public function recipients(): BelongsToMany
    {
        return $this->belongsToMany(Recipient::class, reportTableName('mailable_recipient'));
    }
}
