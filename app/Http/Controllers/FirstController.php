<?php

namespace App\Http\Controllers;

use App\Course;
use App\FirstSuggest1;
use App\FirstSuggest2;
use App\FirstSuggest3;
use App\Part;
use App\Question;
use App\User;
use App\Year;
use Illuminate\Http\Request;

class FirstController extends Controller
{
    public function index(Request $request)
    {
        $page = ($request->input('page'))?$request->input('page'):1;
        //年度選單
        $years = Year::orderBy('year','DESC')->pluck('year','year')->toArray();
        //選擇的年度
        $select_year = ($request->input('year'))?$request->input('year'):current($years);

        $schools = config('course.schools');

        $courses = Course::where('year',$select_year)
            ->where('first_user_id',auth()->user()->id)
            ->paginate('20');

        $data = [
            'page'=>$page,
            'years'=>$years,
            'select_year'=>$select_year,
            'schools'=>$schools,
            'courses'=>$courses,
        ];
        return view('firsts.index',$data);
    }

    public function create1(Course $course)
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
        ];
        return view('firsts.create1',$data);
    }

    public function store1(Request $request)
    {
        $questions = $request->input('questions');
        foreach($questions as $k=>$v){
            $att['question_id'] = $v;
            $att['school_code'] = $request->input('school_code');
            $att['pass'] = $request->input('check_'.$v);
            $att['suggest'] = $request->input('suggest_'.$v);
            FirstSuggest1::create($att);
        }
        $course = Course::find($request->input('course_id'));
        $att2['first_result1'] = $request->input('first_result1');
        $att2['first_reason1'] = $request->input('first_reason1');
        $course->update($att2);


        //通知使用者
        $users = User::where('code',$course->school_code)
            ->get();
        $result = [
            'ok'=>'符合！無需修改！',
            'back'=>'退回！修改後再傳！',
            'excellent'=>'優秀！進入複審！'
        ];
        foreach($users as $user){
            $to = $user->email;
            $line = $user->access_token;
            $subject = "課程計畫初審結果通知----".$result[$request->input('first_result1')];
            $body = "課程計畫初審結果通知----".$result[$request->input('first_result1')]." 請登入 https://course108.chc.edu.tw 查看！" ;
            if($to){
                send_mail($to,$subject,$body);
            }
            if($line){
                line_to($line,$body);
            }
        }

        return redirect()->route('firsts.index');

    }

    public function edit1(Course $course)
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

        foreach($questions as $question){
            $q_array[] = $question->id;
        }

        $first_suggests1 = FirstSuggest1::whereIn('question_id',$q_array)
            ->where('school_code',$course->school_code)
            ->get();

        $f_s1 = [];
        foreach($first_suggests1 as $first_suggest1){
            $f_s1[$first_suggest1->question_id]['pass'] = $first_suggest1->pass;
            $f_s1[$first_suggest1->question_id]['suggest'] = $first_suggest1->suggest;
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
            'f_s1'=>$f_s1,
        ];

        return view('firsts.edit1',$data);
    }

    public function update1(Request $request)
    {
        $questions = $request->input('questions');
        foreach($questions as $k=>$v){
            $first_suggest1 = FirstSuggest1::where('question_id',$v)
                ->where('school_code',$request->input('school_code'))
                ->first();

            $att['pass'] = $request->input('check_'.$v);
            $att['suggest'] = $request->input('suggest_'.$v);

            $first_suggest1->update($att);

        }
        $course = Course::find($request->input('course_id'));
        $att2['first_result1'] = $request->input('first_result1');
        $att2['first_reason1'] = $request->input('first_reason1');
        $course->update($att2);

        //通知使用者
        $users = User::where('code',$course->school_code)
            ->get();
        $result = [
            'ok'=>'符合！無需修改！',
            'back'=>'退回！修改後再傳！',
            'excellent'=>'優秀！進入複審！'
        ];
        foreach($users as $user){
            $to = $user->email;
            $line = $user->access_token;
            $subject = "課程計畫初審結果修改通知----".$result[$request->input('first_result1')];
            $body = "課程計畫初審結果修改通知----".$result[$request->input('first_result1')]." 請登入 https://course108.chc.edu.tw 查看！" ;
            if($to){
                send_mail($to,$subject,$body);
            }
            if($line){
                line_to($line,$body);
            }
        }

        return redirect()->route('firsts.index');
    }

    public function create2(Course $course)
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
        ];
        return view('firsts.create2',$data);
    }

    public function store2(Request $request)
    {
        $questions = $request->input('questions');
        if($questions){
            foreach($questions as $k=>$v){
                $att['question_id'] = $v;
                $att['school_code'] = $request->input('school_code');
                $att['pass'] = $request->input('check_'.$v);
                $att['suggest'] = $request->input('suggest_'.$v);
                FirstSuggest2::create($att);
            }
        }

        $course = Course::find($request->input('course_id'));
        $att2['first_result2'] = $request->input('first_result2');
        $att2['first_reason2'] = $request->input('first_reason2');
        $course->update($att2);

        //通知使用者
        $users = User::where('code',$course->school_code)
            ->get();
        $result = [
            'ok'=>'符合！無需修改！',
            'back'=>'退回！修改後再傳！',
            'excellent'=>'優秀！進入複審！'
        ];
        foreach($users as $user){
            $to = $user->email;
            $line = $user->access_token;
            $subject = "課程計畫初審二傳結果通知----".$result[$request->input('first_result2')];
            $body = "課程計畫初審二傳結果通知----".$result[$request->input('first_result2')]." 請登入 https://course108.chc.edu.tw 查看！" ;
            if($to){
                send_mail($to,$subject,$body);
            }
            if($line){
                line_to($line,$body);
            }
        }

        return redirect()->route('firsts.index');

    }

    public function edit2(Course $course)
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

        foreach($questions as $question){
            $q_array[] = $question->id;
        }

        $first_suggests2 = FirstSuggest2::whereIn('question_id',$q_array)
            ->where('school_code',$course->school_code)
            ->get();

        $f_s2 = [];
        foreach($first_suggests2 as $first_suggest2){
            $f_s2[$first_suggest2->question_id]['pass'] = $first_suggest2->pass;
            $f_s2[$first_suggest2->question_id]['suggest'] = $first_suggest2->suggest;
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
            'f_s2'=>$f_s2,
        ];

        return view('firsts.edit2',$data);
    }

    public function update2(Request $request)
    {
        $questions = $request->input('questions');
        if($questions){
            foreach($questions as $k=>$v){
                $first_suggest2 = FirstSuggest2::where('question_id',$v)
                    ->where('school_code',$request->input('school_code'))
                    ->first();

                $att['pass'] = $request->input('check_'.$v);
                $att['suggest'] = $request->input('suggest_'.$v);

                $first_suggest2->update($att);

            }
        }

        $course = Course::find($request->input('course_id'));
        $att2['first_result2'] = $request->input('first_result2');
        $att2['first_reason2'] = $request->input('first_reason2');
        $course->update($att2);

        //通知使用者
        $users = User::where('code',$course->school_code)
            ->get();
        $result = [
            'ok'=>'符合！無需修改！',
            'back'=>'退回！修改後再傳！',
            'excellent'=>'優秀！進入複審！'
        ];
        foreach($users as $user){
            $to = $user->email;
            $line = $user->access_token;
            $subject = "課程計畫初審二傳結果修改通知----".$result[$request->input('first_result2')];
            $body = "課程計畫初審二傳結果修改通知----".$result[$request->input('first_result2')]." 請登入 https://course108.chc.edu.tw 查看！" ;
            if($to){
                send_mail($to,$subject,$body);
            }
            if($line){
                line_to($line,$body);
            }
        }

        return redirect()->route('firsts.index');
    }

    public function create3(Course $course)
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
        ];
        return view('firsts.create3',$data);
    }

    public function store3(Request $request)
    {
        $questions = $request->input('questions');
        if($questions){
            foreach($questions as $k=>$v){
                $att['question_id'] = $v;
                $att['school_code'] = $request->input('school_code');
                $att['pass'] = $request->input('check_'.$v);
                $att['suggest'] = $request->input('suggest_'.$v);
                FirstSuggest3::create($att);
            }
        }

        $course = Course::find($request->input('course_id'));
        $att2['first_result3'] = $request->input('first_result3');
        $att2['first_reason3'] = $request->input('first_reason3');
        $course->update($att2);

        //通知使用者
        $users = User::where('code',$course->school_code)
            ->get();
        $result = [
            'ok'=>'符合！無需修改！',
            'back'=>'退回！修改後再傳！',
            'excellent'=>'優秀！進入複審！'
        ];
        foreach($users as $user){
            $to = $user->email;
            $line = $user->access_token;
            $subject = "課程計畫初審三傳結果通知----".$result[$request->input('first_result3')];
            $body = "課程計畫初審結果三傳通知----".$result[$request->input('first_result3')]." 請登入 https://course108.chc.edu.tw 查看！" ;
            if($to){
                send_mail($to,$subject,$body);
            }
            if($line){
                line_to($line,$body);
            }
        }

        return redirect()->route('firsts.index');

    }
    public function edit3(Course $course)
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

        foreach($questions as $question){
            $q_array[] = $question->id;
        }

        $first_suggests3 = FirstSuggest3::whereIn('question_id',$q_array)
            ->where('school_code',$course->school_code)
            ->get();

        $f_s3 = [];
        foreach($first_suggests3 as $first_suggest3){
            $f_s3[$first_suggest3->question_id]['pass'] = $first_suggest3->pass;
            $f_s3[$first_suggest3->question_id]['suggest'] = $first_suggest3->suggest;
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
            'f_s3'=>$f_s3,
        ];

        return view('firsts.edit3',$data);
    }

    public function update3(Request $request)
    {
        $questions = $request->input('questions');
        if($questions){
            foreach($questions as $k=>$v){
                $first_suggest3 = FirstSuggest3::where('question_id',$v)
                    ->where('school_code',$request->input('school_code'))
                    ->first();

                $att['pass'] = $request->input('check_'.$v);
                $att['suggest'] = $request->input('suggest_'.$v);

                $first_suggest3->update($att);

            }
        }
        $course = Course::find($request->input('course_id'));
        $att2['first_result3'] = $request->input('first_result3');
        $att2['first_reason3'] = $request->input('first_reason3');
        $course->update($att2);

        //通知使用者
        $users = User::where('code',$course->school_code)
            ->get();
        $result = [
            'ok'=>'符合！無需修改！',
            'back'=>'退回！修改後再傳！',
            'excellent'=>'優秀！進入複審！'
        ];
        foreach($users as $user){
            $to = $user->email;
            $line = $user->access_token;
            $subject = "課程計畫初審三傳結果修改通知----".$result[$request->input('first_result3')];
            $body = "課程計畫初審三傳結果修改通知----".$result[$request->input('first_result3')]." 請登入 https://course108.chc.edu.tw 查看！" ;
            if($to){
                send_mail($to,$subject,$body);
            }
            if($line){
                line_to($line,$body);
            }
        }

        return redirect()->route('firsts.index');
    }
}
