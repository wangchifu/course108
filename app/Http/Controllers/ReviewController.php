<?php

namespace App\Http\Controllers;

use App\Course;
use App\Question;
use App\SpecialReview;
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

        $page = ($request->input('page'))?$request->input('page'):1;

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
            'page'=>$page,
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
        $special_questions = Question::where('year',$select_year)
            ->where('g_s','2')
            ->orderBy('order_by')
            ->get();

        $s_r = [];
        $special_review_id=[];
        $special_reviews = SpecialReview::where('year',$select_year)->get();
        foreach($special_reviews as $special_review){
            $s_r[$special_review->school_code][$special_review->question_id] = $special_review->user->name;
            $special_review_id[$special_review->school_code][$special_review->question_id] = $special_review->id;
        }

        $data = [
            'year_items'=>$year_items,
            'select_year'=>$select_year,
            'schools'=>$schools,
            'courses'=>$courses,
            's_r'=>$s_r,
            'special_review_id'=>$special_review_id,
            'special_questions'=>$special_questions,
        ];
        return view('admin.reviews.index2',$data);
    }

    public function special_review_delete(SpecialReview $special_review)
    {
        $special_review->delete();
        return back();
    }

    public function first_review_delete(Course $course)
    {
        $att['first_user_id'] = null;
        $course->update($att);
        return back();
    }

    public function second_review_delete(Course $course)
    {
        $att['second_user_id'] = null;
        $course->update($att);
        return back();
    }

    public function special_user(Question $question,$select_year,$school_code)
    {
        $users = User::where('group_id',3)->pluck('name','id')->toArray();
        $schools = config('course.schools');
        $data = [
            'users'=>$users,
            'select_year'=>$select_year,
            'school_code'=>$school_code,
            'schools'=>$schools,
            'question'=>$question,
        ];
        return view('admin.reviews.special_user',$data);
    }

    public function special_user_store(Request $request)
    {
        $special_review = SpecialReview::where('year',$request->input('select_year'))
            ->where('question_id',$request->input('question_id'))
            ->where('school_code',$request->input('school_code'))
            ->first();
        $att['year'] = $request->input('select_year');
        $att['question_id'] = $request->input('question_id');
        $att['school_code'] = $request->input('school_code');
        $att['user_id'] = $request->input('user_id');
        if($special_review){

            $special_review->update($att);
        }else{
            SpecialReview::create($att);
        }

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    /**

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
     * */


    public function special_by_user($select_year,Question $question)
    {
        $users = User::where('group_id',3)->pluck('name','id')->toArray();
        $schools = config('course.schools');

        $data = [
            'select_year'=>$select_year,
            'question'=>$question,
            'users'=>$users,
            'schools'=>$schools,
        ];
        return view('admin.reviews.special_by_user',$data);
    }

    public function special_by_user_store(Request $request)
    {
        foreach($request->input('s') as $k=>$v){
            $special_review = SpecialReview::where('year',$request->input('select_year'))
                ->where('question_id',$request->input('question_id'))
                ->where('school_code',$k)
                ->first();
            $att['year'] = $request->input('select_year');
            $att['question_id'] = $request->input('question_id');
            $att['school_code'] = $k;
            $att['user_id'] = $request->input('user_id');
            if($special_review){
                $special_review->update($att);
            }else{
                SpecialReview::create($att);
            }
        }
        echo "<body onload='opener.location.reload();window.close();'>";
    }


    public function not_send($result,$select_year)
    {
        $schools = config('course.schools');
        if($result==1){
            $courses = Course::where('year',$select_year)
            ->where(function($q){
              $q->where('first_result1',null)
                  ->orWhere('first_result1','late');
            })
            ->get();
            foreach($courses as $course){
                echo $schools[$course->school_code]."<br>";
            }
        }
        if($result==2){
            $courses = Course::where('year',$select_year)
                ->where('first_result1','back')
                ->where('first_result2',null)
                ->get();
            foreach($courses as $course){
                echo $schools[$course->school_code]."<br>";
            }
        }
        if($result==3){
            $courses = Course::where('year',$select_year)
                ->where('first_result2','back')
                ->where('first_result3',null)
                ->get();
            foreach($courses as $course){
                echo $schools[$course->school_code]."<br>";
            }
        }
    }

    public function back_null(Course $course,$page,$action)
    {
        if($action=="1"){
            $att['first_result1'] = null;
        }
        if($action=="2"){
            $att['first_result2'] = null;
        }
        if($action=="3"){
            $att['first_result3'] = null;
        }

        $course->update($att);
        return redirect()->route('reviews.index',['page'=>$page]);
    }

    public function show_special($select_year)
    {
        $special_questions = Question::where('year',$select_year)
            ->where('g_s','2')
            ->get();
        $courses = Course::where('year',$select_year)
            ->get();
        $schools = config('course.schools');
        $data = [
            'special_questions'=>$special_questions,
            'courses'=>$courses,
            'schools'=>$schools,
            'select_year'=>$select_year,
        ];
        return view('admin.reviews.show_special',$data);
    }
}
