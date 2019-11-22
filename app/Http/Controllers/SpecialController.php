<?php

namespace App\Http\Controllers;

use App\Course;
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

        $courses = Course::where('year',$select_year)
            ->where('second_user_id',auth()->user()->id)
            ->where(function($q){
                $q->where('first_result1','excellent')
                    ->orWhere('first_result2','excellent')
                    ->orWhere('first_result3','excellent');
            })
            ->get();

        $data = [
            'years'=>$years,
            'select_year'=>$select_year,
            'schools'=>$schools,
            'courses'=>$courses,
        ];
        return view('seconds.index',$data);
    }
}
