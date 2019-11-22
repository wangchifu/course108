<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialReview extends Model
{
    protected $table="special_reviews";

    protected $fillable = [
        'year',
        'question_id',
        'school_code',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
