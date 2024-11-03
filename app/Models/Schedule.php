<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    protected $fillable = [
        'tanggal',
        'desc',
    ];

    public function queue(): HasMany
    {
        return $this->hasMany(Queue::class,'schedule_id');
    }
}
