<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Civitas extends Model
{
    protected $fillable = [
        'nim',
        'fakultas',
        'prodi',
        'address',
        'phone',
        'photo',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): HasMany
    {
        return $this->hsMany(Post::class);
    }
}
