<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstSuggest2 extends Model
{
    protected $table="first_suggests2";

    protected $fillable = [
        'question_id',
        'school_code',
        'pass',
        'suggest',
    ];
}
