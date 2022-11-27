<?php

namespace Dainsys\Report\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AbstractModel extends Model
{
    use HasFactory;

    protected static function booted()
    {
        parent::booted();

        static::saved(function ($user) {
            Cache::flush();
        });
    }

    public function getTable(): string
    {
        return reportTableName(str(get_class($this))->afterLast('\\')->plural()->snake()->lower());
    }
}
