<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'year',
        'school_code',
        'leading',
        'first_user_id',
        'first_result1',
        'first_result2',
        'first_result3',
        'first_reason1',
        'first_reason2',
        'first_reason3',
        'second_user_id',
        'second_result',
        'second_reason',
        'special_result',
        'open',
    ];
}
