<?php

namespace App\Http\Controllers;

use App\Course;
use App\Part;
use App\Question;
use App\User;
use App\Year;
use Illuminate\Http\Request;

class SecondController extends Controller
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

    public function create(Course $course)
    {
        //年度選單
        $year_items = Year::orderBy('year','DESC')->pluck('year','year')->toArray();

        //選擇的年度
        $select_year = ($course->year)?$course->year:current($year_items);

        $part_order_by = config('course.part_order_by');
        $type_items = config('course.type_items');
        $g_s_items = config('course.g_s_items');
        $parts = Part::where('year',$select_year)->orderBy('order_by')->get();
        $questions = Question::where('year',$select_year)->orderBy('order_by')->get();
        $year = Year::where('year',$select_year)->first();

        $schools = config('course.schools');

        $i=0;
        if(strpos($schools[$course->school_code], '國小') !== false) $i = "1";
        if(strpos($schools[$course->school_code], '國中') !== false) $i = "2";

        //九年一貫的年級有哪一些
        if($i==1){
            if($year->e1 == '9year'){
                $year9[] = "一";
            }else{
                $year12[] = "一";
            }
            if($year->e2 == '9year'){
                $year9[] = "二";
            }else{
                $year12[] = "二";
            }
            if($year->e3 == '9year'){
                $year9[] = "三";
            }else{
                $year12[] = "三";
            }
            if($year->e4 == '9year'){
                $year9[] = "四";
            }else{
                $year12[] = "四";
            }
            if($year->e5 == '9year'){
                $year9[] = "五";
            }else{
                $year12[] = "五";
            }
            if($year->e6 == '9year'){
                $year9[] = "六";
            }else{
                $year12[] = "六";
            }

        }elseif($i==2){
            if($year->j1 == '9year'){
                $year9[] = "七";
            }else{
                $year12[] = "七";
            }
            if($year->j2 == '9year'){
                $year9[] = "八";
            }else{
                $year12[] = "八";
            }
            if($year->j3 == '9year'){
                $year9[] = "九";
            }else{
                $year12[] = "九";
            }
        }

        $data = [
            'year_items'=>$year_items,
            'select_year'=>$select_year,
            'part_order_by'=>$part_order_by,
            'type_items'=>$type_items,
            'g_s_items'=>$g_s_items,
            'parts'=>$parts,
            'questions'=>$questions,
            'year'=>$year,
            'year9'=>$year9,
            'year12'=>$year12,
            'course'=>$course,
            'school_code'=>$course->school_code,
            'school_name'=>$schools[$course->school_code],
            'school_group'=>$i,
            'course'=>$course,
        ];
        return view('seconds.create',$data);
    }

    public function update(Request $request)
    {
        $course = Course::find($request->input('course_id'));
        $att['second_result'] = $request->input('second_result');
        $att['second_reason'] = $request->input('second_reason');
        $course->update($att);

        //通知使用者
        $users = User::where('code',$course->school_code)
            ->get();
        $result = [
            'ok'=>'不列入優良學校課程計畫！',
            'excellent1'=>'讚！列入優良學校課程計畫！(特優)',
            'excellent2'=>'讚！列入優良學校課程計畫！(優等)',
            'excellent3'=>'讚！列入優良學校課程計畫！(甲等)',

        ];
        foreach($users as $user){
            $to = $user->email;
            $subject = "課程計畫複審結果通知----".$result[$request->input('second_result')];
            $body = "課程計畫複審結果通知----".$result[$request->input('second_result')]." 請登入 https://course108.chc.edu.tw 查看！" ;
            $line = $user->access_token;
            if($to){
                send_mail($to,$subject,$body);
            }
            if($line){
                line_to($line,$body);
            }
        }

        return redirect()->route('seconds.index');
    }
}
