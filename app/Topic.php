<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'title',
        'part_id',
        'year',
        'order_by',
    ];
    public function part()
    {
        return $this->belongsTo(Part::class);
    }
    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order_by');
    }
}
