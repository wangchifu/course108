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

        /**
        $c3_1_tables = C31Table::where('year',$select_year)
            ->get();
        foreach($c3_1_tables as $c31){
            $section[$c31->school_code][$c31->grade]['mandarin'] = $c31->mandarin;
            $section[$c31->school_code][$c31->grade]['dialects'] = $c31->dialects;
            $section[$c31->school_code][$c31->grade]['english'] = $c31->english;
            $section[$c31->school_code][$c31->grade]['mathematics'] = $c31->mathematics;
            $section[$c31->school_code][$c31->grade]['life_curriculum'] = $c31->life_curriculum;
            $section[$c31->school_code][$c31->grade]['social_studies'] = $c31->social_studies;
            $section[$c31->school_code][$c31->grade]['science'] = ($c31->science)?$c31->science:$c31->science_technology;
            $section[$c31->school_code][$c31->grade]['arts_humanities'] = $c31->arts_humanities;
            $section[$c31->school_code][$c31->grade]['integrative_activities'] = $c31->integrative_activities;
            $section[$c31->school_code][$c31->grade]['technology'] = $c31->technology;
            $section[$c31->school_code][$c31->grade]['health_physical'] = $c31->health_physical;
            $section[$c31->school_code][$c31->grade]['alternative'] = $c31->alternative;
        }


        foreach($courses as $course){
            if(strpos($schools[$course->school_code], '國小') !== false){
                $grades = ['一','二','三','四','五','六'];
                foreach($grades as $v){
                    $school_code = ($v=="一")?$course->school_code:null;
                    $school_name = ($v=="一")?$schools[$course->school_code]:null;
                    $mandarin=(isset($section[$course->school_code][$v]['mandarin']))?$section[$course->school_code][$v]['mandarin']:null;
                    $dialects=(isset($section[$course->school_code][$v]['dialects']))?$section[$course->school_code][$v]['dialects']:null;
                    $english=(isset($section[$course->school_code][$v]['english']))?$section[$course->school_code][$v]['english']:null;
                    $mathematics=(isset($section[$course->school_code][$v]['mathematics']))?$section[$course->school_code][$v]['mathematics']:null;
                    $life_curriculum=(isset($section[$course->school_code][$v]['life_curriculum']))?$section[$course->school_code][$v]['life_curriculum']:null;
                    $social_studies=(isset($section[$course->school_code][$v]['social_studies']))?$section[$course->school_code][$v]['social_studies']:null;
                    $science=(isset($section[$course->school_code][$v]['science']))?$section[$course->school_code][$v]['science']:null;
                    $arts_humanities=(isset($section[$course->school_code][$v]['arts_humanities']))?$section[$course->school_code][$v]['arts_humanities']:null;
                    $integrative_activities=(isset($section[$course->school_code][$v]['integrative_activities']))?$section[$course->school_code][$v]['integrative_activities']:null;
                    $technology=(isset($section[$course->school_code][$v]['technology']))?$section[$course->school_code][$v]['technology']:null;
                    $health_physical=(isset($section[$course->school_code][$v]['mandarin']))?$section[$course->school_code][$v]['mandarin']:null;
                    $alternative=(isset($section[$course->school_code][$v]['alternative']))?$section[$course->school_code][$v]['alternative']:null;


                    $data[] =[
                        '學校代碼'=>$school_code,
                        '學校名稱'=>$school_name,
                        '年級'=>$v,
                        '國語文'=>$mandarin,
                        '本土語文/新住民語文'=>$dialects,
                        '英語文'=>$english,
                        '數學'=>$mathematics,
                        '生活'=>$life_curriculum,
                        '社會'=>$social_studies,
                        '自然'=>$science,
                        '藝術與人文'=>$arts_humanities,
                        '綜合'=>$integrative_activities,
                        '科技'=>$technology,
                        '健康與體育'=>$health_physical,
                        '彈性課程'=>$alternative,
                    ];
                }
            };
            if(strpos($schools[$course->school_code], '國中') !== false){
                $grades = ['七','八','九'];
                foreach($grades as $v){
                    $school_code = ($v=="七")?$course->school_code:null;
                    $school_name = ($v=="七")?$schools[$course->school_code]:null;
                    $mandarin=(isset($section[$course->school_code][$v]['mandarin']))?$section[$course->school_code][$v]['mandarin']:null;
                    $dialects=(isset($section[$course->school_code][$v]['dialects']))?$section[$course->school_code][$v]['dialects']:null;
                    $english=(isset($section[$course->school_code][$v]['english']))?$section[$course->school_code][$v]['english']:null;
                    $mathematics=(isset($section[$course->school_code][$v]['mathematics']))?$section[$course->school_code][$v]['mathematics']:null;
                    $life_curriculum=(isset($section[$course->school_code][$v]['life_curriculum']))?$section[$course->school_code][$v]['life_curriculum']:null;
                    $social_studies=(isset($section[$course->school_code][$v]['social_studies']))?$section[$course->school_code][$v]['social_studies']:null;
                    $science=(isset($section[$course->school_code][$v]['science']))?$section[$course->school_code][$v]['science']:null;
                    $arts_humanities=(isset($section[$course->school_code][$v]['arts_humanities']))?$section[$course->school_code][$v]['arts_humanities']:null;
                    $integrative_activities=(isset($section[$course->school_code][$v]['integrative_activities']))?$section[$course->school_code][$v]['integrative_activities']:null;
                    $technology=(isset($section[$course->school_code][$v]['technology']))?$section[$course->school_code][$v]['technology']:null;
                    $health_physical=(isset($section[$course->school_code][$v]['mandarin']))?$section[$course->school_code][$v]['mandarin']:null;
                    $alternative=(isset($section[$course->school_code][$v]['alternative']))?$section[$course->school_code][$v]['alternative']:null;



                    $data[] =[
                        '學校代碼'=>$school_code,
                        '學校名稱'=>$school_name,
                        '年級'=>$v,
                        '國語文'=>$mandarin,
                        '本土語文/新住民語文'=>$dialects,
                        '英語文'=>$english,
                        '數學'=>$mathematics,
                        '生活'=>$life_curriculum,
                        '社會'=>$social_studies,
                        '自然'=>$science,
                        '藝術與人文'=>$arts_humanities,
                        '綜合'=>$integrative_activities,
                        '科技'=>$technology,
                        '健康與體育'=>$health_physical,
                        '彈性課程'=>$alternative,
                    ];
                }
            };

        }
         * * */

        //$list = collect($data);

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
        $j=0;
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
