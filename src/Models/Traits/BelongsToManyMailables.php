<?php

namespace Dainsys\Report\Models\Traits;

use Dainsys\Report\Models\Mailable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait BelongsToManyMailables
{
    public function mailables(): BelongsToMany
    {
        return $this->belongsToMany(Mailable::class, reportTableName('mailable_recipient'));
    }
}
