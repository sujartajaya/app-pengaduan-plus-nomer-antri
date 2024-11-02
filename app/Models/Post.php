<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'uuid',
        'post',
        'photo',
        'category_id',
        'civitas_id',
        'schedule',
    ];

    public function civitas(): BelongsTo
    {
        return $this->belongsTo(Civitas::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function queue(): HasOne
    {
        return $this->hasOne(Queue::class);
    }
}
