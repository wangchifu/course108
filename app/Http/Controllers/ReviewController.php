<?php

namespace App\Http\Controllers;

use App\Course;
use App\User;
use App\Year;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        //年度選單
        $year_items = Year::orderBy('year','DESC')->pluck('year','year')->toArray();
        //選擇的年度
        $select_year = ($request->input('year'))?$request->input('year'):current($year_items);

        $schools = config('course.schools');

        $courses = Course::where('year',$select_year)
            ->paginate('25');

        //取全部使用者的id2name
        $usersId2Names = usersId2Names();

        $first_name = [];
        $second_name = [];
        $open = [];
        $first_result1 = [];
        $first_result2 = [];
        $first_result3 = [];
        $second_result = [];


        foreach($courses as $course){
            $first_name[$course->school_code] = ($course->first_user_id)?$usersId2Names[$course->first_user_id]:null;
            $second_name[$course->school_code] = ($course->second_user_id)?$usersId2Names[$course->second_user_id]:null;
            $open[$course->school_code] = $course->open;
            $first_result1[$course->school_code] = $course->first_result1;
            $first_result2[$course->school_code] = $course->first_result2;
            $first_result3[$course->school_code] = $course->first_result3;
            $second_result[$course->school_code] = $course->second_result;
        }

        $data = [
            'year_items'=>$year_items,
            'select_year'=>$select_year,
            'schools'=>$schools,
            'courses'=>$courses,
            'first_name'=>$first_name,
            'second_name'=>$second_name,
            'open'=>$open,
            'first_result1'=>$first_result1,
            'first_result2'=>$first_result2,
            'first_result3'=>$first_result3,
            'second_result'=>$second_result,
        ];
        return view('admin.reviews.index',$data);
    }

    public function first_user($select_year,$school_code)
    {
        $users = User::where('group_id',4)->pluck('name','id')->toArray();
        $schools = config('course.schools');
        $data = [
            'users'=>$users,
            'select_year'=>$select_year,
            'school_code'=>$school_code,
            'schools'=>$schools,
        ];
        return view('admin.reviews.first_user',$data);
    }

    public function first_user_store(Request $request)
    {
        $course = Course::where('year',$request->input('select_year'))
            ->where('school_code',$request->input('school_code'))
            ->first();
        $att['first_user_id'] = $request->input('first_user_id');
        $course->update($att);

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function second_user($select_year,$school_code)
    {
        $users = User::where('group_id',5)->pluck('name','id')->toArray();
        $schools = config('course.schools');
        $data = [
            'users'=>$users,
            'select_year'=>$select_year,
            'school_code'=>$school_code,
            'schools'=>$schools,
        ];
        return view('admin.reviews.second_user',$data);
    }

    public function second_user_store(Request $request)
    {
        $course = Course::where('year',$request->input('select_year'))
            ->where('school_code',$request->input('school_code'))
            ->first();
        $att['second_user_id'] = $request->input('second_user_id');
        $course->update($att);

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function first_by_user($select_year)
    {
        $users = User::where('group_id',4)->pluck('name','id')->toArray();
        $schools = config('course.schools');

        $data = [
            'select_year'=>$select_year,
            'users'=>$users,
            'schools'=>$schools,
        ];
        return view('admin.reviews.first_by_user',$data);
    }

    public function first_by_user_store(Request $request)
    {
        foreach($request->input('s') as $k=>$v){
            $course = Course::where('year',$request->input('select_year'))
                ->where('school_code',$k)
                ->first();
            $att['first_user_id'] = $request->input('user_id');
            $course->update($att);
        }
        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function second_by_user($select_year)
    {
        $users = User::where('group_id',5)->pluck('name','id')->toArray();
        $schools = config('course.schools');

        $data = [
            'select_year'=>$select_year,
            'users'=>$users,
            'schools'=>$schools,
        ];
        return view('admin.reviews.second_by_user',$data);
    }

    public function second_by_user_store(Request $request)
    {
        foreach($request->input('s') as $k=>$v){
            $course = Course::where('year',$request->input('select_year'))
                ->where('school_code',$k)
                ->first();
            $att['second_user_id'] = $request->input('user_id');
            $course->update($att);
        }
        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function select_open($select_year,$school_code)
    {
        $att['open'] =1;
        Course::where('year',$select_year)
            ->where('school_code',$school_code)
            ->update($att);
        return back();
    }

    public function select_close($select_year,$school_code)
    {
        $att['open'] =null;
        Course::where('year',$select_year)
            ->where('school_code',$school_code)
            ->update($att);
        return back();
    }

    public function open($select_year)
    {
        $att['open'] =1;
        Course::where('year',$select_year)->update($att);
        return back();
    }

    public function close($select_year)
    {
        $att['open'] =null;
        Course::where('year',$select_year)->update($att);
        return back();
    }

    public function index2(Request $request)
    {
        //年度選單
        $year_items = Year::orderBy('year','DESC')->pluck('year','year')->toArray();
        //選擇的年度
        $select_year = ($request->input('year'))?$request->input('year'):current($year_items);

        $schools = config('course.schools');

        $courses = Course::where('year',$select_year)
            ->paginate('25');

        //取全部使用者的id2name
        $usersId2Names = usersId2Names();

        $special1_name = [];
        $special2_name = [];
        $special3_name = [];


        foreach($courses as $course){
            $special1_name[$course->school_code] = ($course->special1_user_id)?$usersId2Names[$course->special1_user_id]:null;
            $special2_name[$course->school_code] = ($course->special2_user_id)?$usersId2Names[$course->special2_user_id]:null;
            $special3_name[$course->school_code] = ($course->special3_user_id)?$usersId2Names[$course->special3_user_id]:null;
        }

        $data = [
            'year_items'=>$year_items,
            'select_year'=>$select_year,
            'schools'=>$schools,
            'courses'=>$courses,
            'special1_name'=>$special1_name,
            'special2_name'=>$special2_name,
            'special3_name'=>$special3_name,
        ];
        return view('admin.reviews.index2',$data);
    }

    public function special1_user($select_year,$school_code)
    {
        $users = User::where('group_id',3)->pluck('name','id')->toArray();
        $schools = config('course.schools');
        $data = [
            'users'=>$users,
            'select_year'=>$select_year,
            'school_code'=>$school_code,
            'schools'=>$schools,
        ];
        return view('admin.reviews.special1_user',$data);
    }


    public function special2_user($select_year,$school_code)
    {
        $users = User::where('group_id',3)->pluck('name','id')->toArray();
        $schools = config('course.schools');
        $data = [
            'users'=>$users,
            'select_year'=>$select_year,
            'school_code'=>$school_code,
            'schools'=>$schools,
        ];
        return view('admin.reviews.special2_user',$data);
    }

    public function special3_user($select_year,$school_code)
    {
        $users = User::where('group_id',3)->pluck('name','id')->toArray();
        $schools = config('course.schools');
        $data = [
            'users'=>$users,
            'select_year'=>$select_year,
            'school_code'=>$school_code,
            'schools'=>$schools,
        ];
        return view('admin.reviews.special3_user',$data);
    }

    public function special1_user_store(Request $request)
    {
        $course = Course::where('year',$request->input('select_year'))
            ->where('school_code',$request->input('school_code'))
            ->first();
        $att['special1_user_id'] = $request->input('special1_user_id');
        $course->update($att);

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function special2_user_store(Request $request)
    {
        $course = Course::where('year',$request->input('select_year'))
            ->where('school_code',$request->input('school_code'))
            ->first();
        $att['special2_user_id'] = $request->input('special2_user_id');
        $course->update($att);

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function special3_user_store(Request $request)
    {
        $course = Course::where('year',$request->input('select_year'))
            ->where('school_code',$request->input('school_code'))
            ->first();
        $att['special3_user_id'] = $request->input('special3_user_id');
        $course->update($att);

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function special_by_user($select_year,$special)
    {
        $users = User::where('group_id',3)->pluck('name','id')->toArray();
        $schools = config('course.schools');

        $data = [
            'select_year'=>$select_year,
            'special'=>$special,
            'users'=>$users,
            'schools'=>$schools,
        ];
        return view('admin.reviews.special_by_user',$data);
    }

    public function special_by_user_store(Request $request)
    {
        foreach($request->input('s') as $k=>$v){
            $course = Course::where('year',$request->input('select_year'))
                ->where('school_code',$k)
                ->first();
            if($request->input('special')=="1"){
                $att['special1_user_id'] = $request->input('user_id');
            }
            if($request->input('special')=="2"){
                $att['special2_user_id'] = $request->input('user_id');
            }
            if($request->input('special')=="3"){
                $att['special3_user_id'] = $request->input('user_id');
            }

            $course->update($att);
        }
        echo "<body onload='opener.location.reload();window.close();'>";
    }
}