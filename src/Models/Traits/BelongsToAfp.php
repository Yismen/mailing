<?php

namespace Dainsys\Report\Models\Traits;

use Dainsys\Report\Models\Afp;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelongsToAfp
{
    public function afp(): BelongsTo
    {
        return $this->belongsTo(Afp::class);
    }
}
