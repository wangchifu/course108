<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $fillable = [
        'year',
        'question_id',
        'code',
        'file',
    ];
    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
