<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'tanggal',
        'desc',
    ];

    public function queue(): HasMany
    {
        return $this->hasMany(Queue::class);
    }
}
