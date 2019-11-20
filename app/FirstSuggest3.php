<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstSuggest3 extends Model
{
    protected $table="first_suggests3";

    protected $fillable = [
        'question_id',
        'school_code',
        'pass',
        'suggest',
    ];
}
