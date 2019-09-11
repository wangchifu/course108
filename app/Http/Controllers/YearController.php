<?php

namespace App\Http\Controllers;

use App\C31Table;
use App\C81Table;
use App\Course;
use App\Part;
use App\Question;
use App\Topic;
use App\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function index()
    {
        $years = Year::orderBy('year','DESC')->get();
        $data = [
            'years'=>$years,
        ];
        return view('admin.years.index',$data);
    }

    public function create()
    {
        $courses = config('course.courses');//九年 或 十二年 課程的選單陣列
        $data = [
            'courses'=>$courses,
        ];
        return view('admin.years.create',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
           'year'=>'required|numeric||between:100,999',
            'step1_date1'=>'required|date_format:"Y-m-d"',
            'step1_date2'=>'required|date_format:"Y-m-d"|after:step1_date1',
            'step2_date1'=>'required|date_format:"Y-m-d"',
            'step2_date2'=>'required|date_format:"Y-m-d"|after:step2_date1',
            'step2_1_date1'=>'required|date_format:"Y-m-d"',
            'step2_1_date2'=>'required|date_format:"Y-m-d"|after:step2_1_date1',
            'step2_2_date1'=>'required|date_format:"Y-m-d"',
            'step2_2_date2'=>'required|date_format:"Y-m-d"|after:step2_2_date1',
            'step3_date1'=>'required|date_format:"Y-m-d"',
            'step3_date2'=>'required|date_format:"Y-m-d"|after:step3_date1',
            'step4_date1'=>'required|date_format:"Y-m-d"',
            'step4_date2'=>'required|date_format:"Y-m-d"|after:step4_date1',
        ]);
        $att = $request->all();

        $check_year = Year::where('year',$att['year'])->first();
        if($check_year){
            $words = "該年度已經設定，請先刪除！";
            return view('layouts.page_error',compact('words'));
        };

        $year = Year::create($att);

        return redirect()->route('years.index');
    }

    public function show(Year $year)
    {
        $data = [
            'year'=>$year,
        ];

        return view('admin.years.show',$data);
    }

    public function edit(Year $year)
    {
        $courses = config('course.courses');//九年 或 十二年 課程的選單陣列
        $data = [
            'courses'=>$courses,
            'year'=>$year,
        ];
        return view('admin.years.edit',$data);
    }

    public function update(Request $request, Year $year)
    {
        $request->validate([
            'year'=>'required|numeric||between:100,999',
            'step1_date1'=>'required|date_format:"Y-m-d"',
            'step1_date2'=>'required|date_format:"Y-m-d"|after:step1_date1',
            'step2_date1'=>'required|date_format:"Y-m-d"',
            'step2_date2'=>'required|date_format:"Y-m-d"|after:step2_date1',
            'step2_1_date1'=>'required|date_format:"Y-m-d"',
            'step2_1_date2'=>'required|date_format:"Y-m-d"|after:step2_1_date1',
            'step2_2_date1'=>'required|date_format:"Y-m-d"',
            'step2_2_date2'=>'required|date_format:"Y-m-d"|after:step2_2_date1',
            'step3_date1'=>'required|date_format:"Y-m-d"',
            'step3_date2'=>'required|date_format:"Y-m-d"|after:step3_date1',
            'step4_date1'=>'required|date_format:"Y-m-d"',
            'step4_date2'=>'required|date_format:"Y-m-d"|after:step4_date1',
        ]);
        $att = $request->all();

        $year->update($att);

        return redirect()->route('years.index');

    }

    public function destroy(Year $year)
    {
        Part::where('year',$year->year)->delete();
        Topic::where('year',$year->year)->delete();
        Question::where('year',$year->year)->delete();
        $year->delete();

        return redirect()->route('years.index');
    }
}
