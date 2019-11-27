<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseOld extends Model
{
    protected $table="courses_old";
    protected $fillable = [
        'year',
        'school_code',
        'leading',
        'c1_1',
        'c1_2',
        'c2',
        'c3_1',
        'c3_2',
        'c3_3',
        'c4',
        'c6',
        'c7_1',
        'c7_2',
        'c8_1',
        'c8_2',
        'c9',
        'c10_1',
        'c10_2_1',
        'c10_2_2',
        'c10_2_3',
        'c10_2_4',
        'c10_2_5',
        'c10_2_date',
        'c11',
        'c12',
        'c13',
        'c13_1',
        'c13_2',
        'c13_3',
        'c14',
        'special13_user_id',
        'special13_1_user_id',
        'special13_2_user_id',
        'special13_3_user_id',
        'first_user_id',
        'first_result1',
        'first_result2',
        'first_result3',
        'second_user_id',
        'second_result',
        'open',
    ];

    public function special_suggest13()
    {
        return $this->hasOne(SpecialSuggest13::class);
    }

    public function special_suggest13_1()
    {
        return $this->hasOne(SpecialSuggest131::class);
    }

    public function special_suggest13_2()
    {
        return $this->hasOne(SpecialSuggest132::class);
    }

    public function special_suggest13_3()
    {
        return $this->hasOne(SpecialSuggest133::class);
    }

    public function first_suggest1()
    {
        return $this->hasOne(FirstSuggest1::class);
    }
    public function first_suggest2()
    {
        return $this->hasOne(FirstSuggest2::class);
    }
    public function first_suggest3()
    {
        return $this->hasOne(FirstSuggest3::class);
    }
    public function second_suggest()
    {
        return $this->hasOne(SecondSuggest::class);
    }
}
