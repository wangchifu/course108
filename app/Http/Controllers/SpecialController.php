<?php

namespace App\Http\Controllers;

use App\Course;
use App\Question;
use App\SpecialReview;
use App\SpecialSuggest;
use App\Year;
use Illuminate\Http\Request;

class SpecialController extends Controller
{
    public function index(Request $request)
    {
        //年度選單
        $years = Year::orderBy('year','DESC')->pluck('year','year')->toArray();
        //選擇的年度
        $select_year = ($request->input('year'))?$request->input('year'):current($years);

        $schools = config('course.schools');

        $special_questions = Question::where('year',$select_year)
            ->where('g_s','2')
            ->orderBy('order_by')
            ->get();

        $special_reviews = SpecialReview::where('year',$select_year)
            ->where('user_id',auth()->user()->id)
            ->get();
        foreach($special_reviews as $special_review){
            $special_review_data[$special_review->school_code][$special_review->question_id]['user'] = $special_review->user_id;
            $special_review_data[$special_review->school_code][$special_review->question_id]['id'] = $special_review->id;
        }

        $data = [
            'years'=>$years,
            'select_year'=>$select_year,
            'schools'=>$schools,
            'special_review_data'=>$special_review_data,
            'special_questions'=>$special_questions,
        ];
        return view('specials.index',$data);
    }

    public function create(SpecialReview $special_review)
    {
        $schools = config('course.schools');
        $school_name = $schools[$special_review->school_code];

        $data = [
            'school_name'=>$school_name,
            'special_review'=>$special_review,
        ];

        return view('specials.create',$data);
    }

    public function store(Request $request)
    {
        $att['question_id'] =$request->input('question_id');
        $att['school_code'] =$request->input('school_code');
        $att['pass'] =$request->input('pass');
        $att['suggest'] =$request->input('suggest');
        $special_suggest = SpecialSuggest::where('question_id',$att['question_id'])
            ->where('school_code',$att['school_code'])
            ->first();
        if($special_suggest){
            $special_suggest->update($att);
        }else{
            SpecialSuggest::create($att);
        }
        return redirect()->route('specials.index');
    }
}
