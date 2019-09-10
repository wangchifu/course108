<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    protected $fillable = [
        'title',
        'year',
        'order_by',
    ];

    public function topics()
    {
        return $this->hasMany(Topic::class)->orderBy('order_by');
    }
}
