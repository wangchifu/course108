<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstSuggest1 extends Model
{
    protected $table="first_suggests1";

    protected $fillable = [
        'question_id',
        'school_code',
        'pass',
        'suggest',
    ];
}
