<?php

namespace App\Http\Controllers;

use App\Course;
use App\Question;
use App\Upload;
use App\Year;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class ExportController extends Controller
{
    public function index(Request $request)
    {
        //年度選單
        $years = Year::orderBy('year','DESC')->pluck('year','year')->toArray();
        //選擇的年度
        $select_year = ($request->input('year'))?$request->input('year'):current($years);

        $data = [
            'years'=>$years,
            'select_year'=>$select_year,
        ];
        return view('admin.exports.index',$data);
    }

    public function section($select_year)
    {
        $courses = Course::where('year',$select_year)
            ->get();
        $schools = config('course.schools');

        $subjects = config('course.subjects');


        $subject_question = Question::where('type',3)
            ->first();

        $i=0;
        foreach($courses as $course){
            if(strpos($schools[$course->school_code], '國小') !== false) {
                $grades = ['一', '二', '三', '四', '五', '六'];
            }
            if(strpos($schools[$course->school_code], '國中') !== false) {
                $grades = ['七', '八', '九'];
            }
            $data[$i] =[
                '學校代碼'=>$course->school_code,
                '學校名稱'=>$schools[$course->school_code],
            ];

            $upload = Upload::where('question_id',$subject_question->id)
                ->where('code',$course->school_code)
                ->first();

            foreach($grades as $v1){
                $data[$i]['年級'] = $v1;
                foreach($subjects as $k=>$v){
                    if($upload){
                        $s = unserialize($upload->file);
                        $ss = (isset($s[$k."_section"][$v1]))?$s[$k."_section"][$v1]:null;
                        $data[$i][$v] = $ss;
                    }else{
                        $data[$i][$v] = null;
                    }
                }
                $i++;
                $data[$i] =[
                    '學校代碼'=>"",
                    '學校名稱'=>"",
                ];
            }
        }

        $list = collect($data);

        return (new FastExcel($list))->download($select_year.'各校課程學習節數.xlsx');
    }

    public function show_date($select_year)
    {

        $courses = Course::where('year',$select_year)
            ->get();
        $schools = config('course.schools');
        $date_questions = Question::where('type',8)
            ->get();

        $i=0;
        foreach($courses as $course){
            $data[$i] =[
                '學校代碼'=>$course->school_code,
                '學校名稱'=>$schools[$course->school_code],
            ];
            foreach($date_questions as $question){
                $upload = Upload::where('question_id',$question->id)
                    ->where('code',$course->school_code)
                    ->first();
                if($upload){
                    $data[$i][$question->title] = $upload->file;
                }else{
                    $data[$i][$question->title] = null;
                }
            }
            $i++;
        }

        $list = collect($data);

        return (new FastExcel($list))->download($select_year.'課程計畫通過日期.xlsx');
    }
}
