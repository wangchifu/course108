<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'year',
        'school_code',
        'leading',
        'special1_user_id',
        'special2_user_id',
        'special3_user_id',
        'first_user_id',
        'first_result1',
        'first_result2',
        'first_result3',
        'second_user_id',
        'second_result',
        'special_result',
        'open',
    ];
}
