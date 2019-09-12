<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'year',
        'school_code',
        'event',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
