<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    protected $fillable = [
        'year',
        'e1',
        'e2',
        'e3',
        'e4',
        'e5',
        'e6',
        'j1',
        'j2',
        'j3',
        'step1_date1',
        'step1_date2',
        'step2_date1',
        'step2_date2',
        'step2_1_date1',
        'step2_1_date2',
        'step2_2_date1',
        'step2_2_date2',
        'step3_date1',
        'step3_date2',
        'step4_date1',
        'step4_date2',
    ];
    public function parts()
    {
        return $this->hasMany(Part::class);
    }
}
