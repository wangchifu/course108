<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'title',
        'topic_id',
        'year',
        'order_by',
        'type',
        'g_s',
    ];
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
