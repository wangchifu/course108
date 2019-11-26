<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'for_school_code',
        'for_user_id',
        'from_user_id',
        'message',
        'has_read',
    ];

    public function from_user()
    {
        return $this->belongsTo(User::class,'from_user_id','id');
    }

    public function for_user()
    {
        return $this->belongsTo(User::class,'for_user_id','id');
    }
}
