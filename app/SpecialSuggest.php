<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialSuggest extends Model
{
    protected $table="special_suggests";

    protected $fillable = [
        'question_id',
        'school_code',
        'pass',
        'suggest',
    ];
}
