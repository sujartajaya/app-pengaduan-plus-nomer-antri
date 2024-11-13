<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = [
        'schedule_id',
        'post_id',
        'civitas_id',
        'number',
        'status',
        'checkin',
    ];

    public function post(): BelongTo
    {
        return $this->belongsTo(Post::class);
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class,'schedule_id');
    }

    public function civitas(): BelongTo
    {
        return $this->belongsTo(Civitas::class);
    }
}
