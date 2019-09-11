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
}
