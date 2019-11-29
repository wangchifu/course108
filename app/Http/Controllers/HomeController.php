<?php

namespace App\Http\Controllers;

use App\C31Table;
use App\C81Table;
use App\Course;
use App\CourseOld;
use App\FirstSuggest1;
use App\FirstSuggest2;
use App\FirstSuggest3;
use App\Message;
use App\Part;
use App\SecondSuggestOld;
use App\SpecialReview;
use App\SpecialSuggest;
use App\SpecialSuggest131;
use App\SpecialSuggest132;
use App\SpecialSuggest133;
use App\Upload;
use App\User;
use App\Year;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        return view('admin');
    }

    public function reset_pwd()
    {
        return view('reset_pwd');
    }

    public function update_pwd(Request $request)
    {
        $request->validate([
            'password1'=>'required|same:password2'
        ]);
        if(password_verify($request->input('password0'), auth()->user()->password)){
            $att['password'] = bcrypt($request->input('password1'));
            User::where('id',auth()->user()->id)->update($att);
            return redirect()->route('index');
        }else{
            return back()->withErrors('舊密碼錯誤');
        }

    }

    public function notify()
    {
        $groups = config('course.groups');
        $schools = config('course.schools');
        $messages = Message::where(function($q){
                $q->where('for_school_code','<>',null)
                    ->Where('for_school_code',auth()->user()->code);
            })->orWhere('from_user_id',auth()->user()->id)
            ->orWhere('for_user_id',auth()->user()->id)
            ->orderBy('created_at','DESC')
            ->get();

        $data = [
            'groups'=>$groups,
            'schools'=>$schools,
            'messages'=>$messages,
        ];
        return view('notify',$data);
    }

    public function notify_read(Message $message)
    {
        $att['has_read'] =1;
        $message->update($att);
        return redirect()->route('notify');
    }

    public function email_store(Request $request)
    {
        $request->validate([
            'email' => 'email',
        ]);

        $att['email'] = $request->input('email');
        $user = User::find(auth()->user()->id);
        $user->update($att);
        return redirect()->route('index');
    }

    public function callback(Request $request)
    {
        if($request->input('error')=="access_denied"){
            echo "<body onload='opener.location.reload();window.close();'>";
        }else{
            $code = ($request->input('code'));
            $token = get_line_token($code);
            if($token){
                $att['access_token'] = $token;
                $user = User::find(auth()->user()->id);
                $user->update($att);

            }
        }
        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function cancel()
    {
        $att['access_token'] = null;
        $user = User::find(auth()->user()->id);
        $user->update($att);

        return redirect()->route('schools.index');
    }

    public function message(Request $request)
    {
        $groups = config('course.groups');
        $school_code = $request->input('school_code');
        $for_user_id = $request->input('for_user_id');
        $schools = config('course.schools');
        if($for_user_id){
            $for_user = User::find($for_user_id);
        }else{
            $for_user = "";
        }

        $data = [
            'groups'=>$groups,
            'school_code'=>$school_code,
            'for_user_id'=>$for_user_id,
            'schools'=>$schools,
            'for_user'=>$for_user,
        ];

        return view('message',$data);
    }

    public function message_store(Request $request)
    {
        $att['for_school_code'] = $request->input('for_school_code');
        $att['for_user_id'] = $request->input('for_user_id');
        $att['from_user_id'] = auth()->user()->id;
        $att['message'] = $request->input('message');
        Message::create($att);

        return redirect()->route('notify');
    }

    public function share(Request $request)
    {
        //年度選單
        $years = Year::orderBy('year','DESC')->pluck('year','year')->toArray();
        //選擇的年度
        $select_year = ($request->input('year'))?$request->input('year'):current($years);


        if(check_date($select_year,4)){
            $words = check_date($select_year,4);
            return view('layouts.page_error',compact('words'));
        };

        $courses = Course::where('year',$select_year)
            ->get();
        foreach($courses as $course){
            $open[$course->school_code] = ($course->open)?"<i class='fas fa-check-circle'></i> ":"";
        }

        $data = [
            'years'=>$years,
            'select_year'=>$select_year,
            'open'=>$open,
        ];
        return view('share',$data);
    }

    public function share_one($select_year,$school_code)
    {
        $year = [];
        if($select_year){
            $part_order_by = config('course.part_order_by');
            $type_items = config('course.type_items');
            $g_s_items = config('course.g_s_items');
            $parts = Part::where('year',$select_year)->orderBy('order_by')->get();
            $year = Year::where('year',$select_year)->first();
        }

        $schools = config('course.schools');

        if(strpos($schools[$school_code], '國小') !== false) $school_group = "1";
        if(strpos($schools[$school_code], '國中') !== false) $school_group = "2";

        //九年一貫的年級有哪一些
        if($school_group==1){
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

        }elseif($school_group==2){
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
        $course =Course::where('year',$select_year)
            ->where('school_code',$school_code)
            ->first();

        if($course->open != 1){
            echo "<body onload=alert('尚未公開！');window.close();>";
            die();
        }
        if(check_date($select_year,4)){
            echo "<body onload=alert('非開放查詢日期！');window.close();>";
            die();
        }

        $data = [
            'course'=>$course,
            'select_year'=>$select_year,
            'school_name'=>$schools[$school_code],
            'parts'=>$parts,
            'part_order_by'=>$part_order_by,
            'school_code'=>$school_code,
            'year'=>$year,
            'school_group'=>$school_group,
            'year9'=>$year9,
            'year12'=>$year12,
        ];
        return view('share_one',$data);
    }

    public function excellent(Request $request)
    {
        //年度選單
        $years = Year::orderBy('year','DESC')->pluck('year','year')->toArray();
        //選擇的年度
        $select_year = ($request->input('year'))?$request->input('year'):current($years);

        /**
        $courses =Course::where('year',$select_year)
            ->where('open',1)
            ->where(function($q){
                $q->where('second_result','excellent1')
                    ->orWhere('second_result','excellent2')
                    ->orWhere('second_result','excellent3');

            })->get();
         * */
        $courses1 = Course::where('year',$select_year)
            ->where('open',1)
            ->where('second_result','excellent1')
            ->get();
        $courses2 = Course::where('year',$select_year)
            ->where('open',1)
            ->where('second_result','excellent2')
            ->get();
        $courses3 = Course::where('year',$select_year)
            ->where('open',1)
            ->where('second_result','excellent3')
            ->get();

        $schools = config('course.schools');

        $data = [
            'years'=>$years,
            'select_year'=>$select_year,
            'courses1'=>$courses1,
            'courses2'=>$courses2,
            'courses3'=>$courses3,
            'schools'=>$schools,
        ];
        return view('excellent',$data);
    }
}
