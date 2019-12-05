<?php

namespace App\Http\Controllers;

use App\Book;
use App\Course;
use App\Http\Requests\UploadRequest;
use App\Log;
use App\Part;
use App\Question;
use App\Upload;
use App\Year;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        //年度選單
        $year_items = Year::orderBy('year','DESC')->pluck('year','year')->toArray();
        //選擇的年度
        $select_year = ($request->input('year'))?$request->input('year'):current($year_items);

        $year = [];
        if($select_year){
            $part_order_by = config('course.part_order_by');
            $type_items = config('course.type_items');
            $g_s_items = config('course.g_s_items');
            $parts = Part::where('year',$select_year)->orderBy('order_by')->get();
            $year = Year::where('year',$select_year)->first();


            //若期限已過，則各校設為 late
            $late_courses = Course::where('first_result1',null)
                ->where('year',$select_year)
                ->get();
            $die1 = str_replace('-','',$year->step1_date2);
            if(date('Ymd') > $die1){
                foreach($late_courses as $late_course){
                    $att['first_result1'] = "late";
                    $late_course->update($att);
                }
            }
        }


        //九年一貫的年級有哪一些
        if(auth()->user()->group_id==1){
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

        }elseif(auth()->user()->group_id==2){
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

        $course = Course::where('year',$select_year)
            ->where('school_code',auth()->user()->code)
            ->first();

        $schools = config('course.schools');
        $i=0;
        if(strpos($schools[$course->school_code], '國小') !== false) $i = "1";
        if(strpos($schools[$course->school_code], '國中') !== false) $i = "2";

        $data = [
            'year_items'=>$year_items,
            'select_year'=>$select_year,
            'part_order_by'=>$part_order_by,
            'type_items'=>$type_items,
            'g_s_items'=>$g_s_items,
            'parts'=>$parts,
            'year'=>$year,
            'year9'=>$year9,
            'year12'=>$year12,
            'course'=>$course,
            'school_code'=>$course->school_code,
            'school_name'=>$schools[$course->school_code],
            'school_group'=>$i,
        ];
        return view('school.index',$data);
    }

    public function edit($select_year)
    {
        //非可編輯日期期限即返回
        if(!check_date($select_year,'1') and !check_date($select_year,'2_1') and !check_date($select_year,'2_2')){
            return back();
        }

        $year = Year::where('year',$select_year)->first();

        $course = Course::where('year',$select_year)
            ->where('school_code',auth()->user()->code)
            ->first();
        //如果已送出，不可編輯
        $u =explode('/',$_SERVER['REQUEST_URI']);
        if($u[2]=="edit" and $course->first_result1=="submit"){
            return back();
        }
        if($u[2]=="edit" and $course->first_result2=="submit"){
            return back();
        }
        if($u[2]=="edit" and $course->first_result3=="submit"){
            return back();
        }
        /**
        if($u[2]=="edit2" and $course->special_result=="submit"){
            return back();
        }
         * */

        $part_order_by = config('course.part_order_by');
        $type_items = config('course.type_items');
        $g_s_items = config('course.g_s_items');
        $questions = Question::where('year',$select_year)->orderBy('order_by')->get();

        $parts = Part::where('year',$select_year)->orderBy('order_by')->get();

        //九年一貫的年級有哪一些
        if(auth()->user()->group_id==1){
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

        }elseif(auth()->user()->group_id==2){
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
            'part_order_by'=>$part_order_by,
            'type_items'=>$type_items,
            'g_s_items'=>$g_s_items,
            'parts'=>$parts,
            'year'=>$year,
            'questions'=>$questions,
            'year9'=>$year9,
            'year12'=>$year12,
            'course'=>$course,
        ];
        return view('school.edit',$data);
    }

    public function show_log($year)
    {
        $logs = Log::where('year',$year)
            ->where('school_code',auth()->user()->code)
            ->orderBy('id','DESC')
            ->get();
        $data = [
            'logs'=>$logs,
        ];
        return view('school.log',$data);
    }

    public function upload1($select_year,Question $question)
    {
        $data = [
            'select_year'=>$select_year,
            'question'=>$question,
        ];
        return view('school.upload1',$data);
    }

    public function save1(UploadRequest $request)
    {
        $select_year = $request->input('select_year');
        $question_id = $request->input('question_id');
        //處理檔案上傳
        if ($request->hasFile('files')) {
            //先刪除已經有的
            $upload = Upload::where('question_id',$question_id)
                ->where('code',auth()->user()->code)
                ->first();
            if($upload){
                $old_file = storage_path('app/public/upload/'.$select_year.'/'.auth()->user()->code.'/'.$question_id.'/'.$upload->file);
                unlink($old_file);
                $upload->delete();
            }

            $files = $request->file('files');

            $att['file'] = "";

            foreach($files as $file){
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];
                $new_filename = date('YmdHis').'-'.$info['original_filename'];
                $file->storeAs('public/upload/'.$select_year.'/'.auth()->user()->code.'/'.$question_id,$new_filename);

                $att['code'] = auth()->user()->code;
                $att['question_id'] = $question_id;
                $att['year'] = $select_year;
                $att['file'] .= ','.$new_filename;
            }
            $att['file'] = substr($att['file'],1);
            $upload = Upload::create($att);

                write_log('上傳 '.$upload->question->order_by.' 題檔案',$select_year);
        }

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function delete1($file_path)
    {
        $file_path = str_replace('&&','/',$file_path);
        $f = explode('/',$file_path);

        $file = storage_path('app/public/upload/'.$file_path);

        $upload = Upload::where('question_id',$f[2])
            ->where('code',auth()->user()->code)
            ->first();
        $upload->delete();
        unlink($file);

        write_log('刪除已上傳的 '.$upload->question->order_by.' 題檔案',$upload->year);

        return redirect()->route('schools.edit',$f[0]);
    }

    public function upload2($select_year,Question $question)
    {
        $data = [
            'select_year'=>$select_year,
            'question'=>$question,
        ];
        return view('school.upload2',$data);
    }

    public function save2(UploadRequest $request)
    {
        $select_year = $request->input('select_year');
        $question_id = $request->input('question_id');
        //處理檔案上傳
        if ($request->hasFile('files')) {
            //先查詢有無上傳過
            $upload = Upload::where('question_id',$question_id)
                ->where('code',auth()->user()->code)
                ->first();
            if($upload){
                $att['file'] = $upload->file;
            }else{
                $att['file'] = "";
            }

            $files = $request->file('files');

            foreach($files as $file){
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];
                $new_filename = date('YmdHis').'-'.$info['original_filename'];
                $file->storeAs('public/upload/'.$select_year.'/'.auth()->user()->code.'/'.$question_id,$new_filename);

                $att['code'] = auth()->user()->code;
                $att['question_id'] = $question_id;
                $att['year'] = $select_year;
                $att['file'] .= ','.$new_filename;
            }

            if(substr($att['file'],0,1)==","){
                $att['file'] = substr($att['file'],1);
            }

            if($upload){
                $upload->update($att);
            }else{
                $upload = Upload::create($att);
            }


            write_log('上傳 '.$upload->question->order_by.' 題檔案',$select_year);
        }

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function delete2($file_path)
    {
        $file_path = str_replace('&&','/',$file_path);
        $f = explode('/',$file_path);

        $file = storage_path('app/public/upload/'.$file_path);

        $upload = Upload::where('question_id',$f[2])
            ->where('code',auth()->user()->code)
            ->first();
        $ff = explode(',',$upload->file);

        //移除所選檔案
        $new_file = "";
        foreach($ff as $k=>$v){
            if($v != $f[3]){
                $new_file .= $v.",";
            }
        }
        $att['file'] = substr($new_file,0,-1);
        if($att['file'] == ""){
            $upload->delete();
        }else{
            $upload->update($att);
        }

        unlink($file);

        write_log('刪除已上傳的 '.$upload->question->order_by.' 題檔案'.' '.substr($f[3],15),$upload->year);

        return redirect()->route('schools.edit',$f[0]);
    }

    public function upload3($select_year,Question $question)
    {
        $year = Year::where('year',$select_year)->first();

        $year9 = [];
        $year12= [];
        //九年一貫的年級有哪一些
        if(auth()->user()->group_id==1){
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

        }elseif(auth()->user()->group_id==2){
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

        $section9 = config('course.section9');
        $section12 = config('course.section12');


        $data = [
            'year'=>$year,
            'select_year'=>$select_year,
            'question'=>$question,
            'year9'=>$year9,
            'year12'=>$year12,
            'section9'=>$section9,
            'section12'=>$section12,
        ];
        return view('school.upload3',$data);
    }

    public function save3(Request $request)
    {
        $select_year = $request->input('select_year');
        $question_id = $request->input('question_id');

        $section['mandarin_section'] = $request->input('mandarin_section');
        $section['dialects_section'] = $request->input('dialects_section');
        $section['english_section'] = $request->input('english_section');
        $section['mathematics_section'] = $request->input('mathematics_section');
        $section['life_curriculum_section'] = $request->input('life_curriculum_section');
        $section['social_studies_section'] = $request->input('social_studies_section');
        $section['science_technology_section'] = $request->input('science_technology_section');
        $section['science_section'] = $request->input('science_section');
        $section['arts_humanities_section'] = $request->input('arts_humanities_section');
        $section['integrative_activities_section'] = $request->input('integrative_activities_section');
        $section['technology_section'] = $request->input('technology_section');
        $section['health_physical_section'] = $request->input('health_physical_section');
        $section['alternative_section'] = $request->input('alternative_section');


        $att['file'] = serialize($section);

        $att['code'] = auth()->user()->code;
        $att['question_id'] = $question_id;
        $att['year'] = $select_year;

        Upload::create($att);

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function print(Upload $upload)
    {
        $year = Year::where('year',$upload->year)->first();
        //九年一貫的年級有哪一些
        if(auth()->user()->group_id==1){
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

        }elseif(auth()->user()->group_id==2){
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

        $area_section = unserialize($upload->file);

        $data = [
            'year'=>$year,
            'year9'=>$year9,
            'year12'=>$year12,
            'area_section'=>$area_section,
        ];
        return view('school.print',$data);
    }

    public function delete3(Upload $upload)
    {
        $upload->delete();
        return redirect()->route('schools.edit',$upload->year);
    }

    public function upload4($select_year,Question $question,$grade,$subject)
    {
        $subjects = config('course.subjects');
        $data = [
            'select_year'=>$select_year,
            'question'=>$question,
            'subject'=>$subject,
            'subjects'=>$subjects,
            'grade'=>$grade,
        ];
        return view('school.upload4',$data);
    }

    public function save4(UploadRequest $request)
    {
        $select_year = $request->input('select_year');
        $question_id = $request->input('question_id');
        $grade = $request->input('grade');
        $subject = $request->input('subject');


        //處理檔案上傳
        if ($request->hasFile('files')) {
            //先查詢有無上傳過
            $upload = Upload::where('question_id',$question_id)
                ->where('code',auth()->user()->code)
                ->first();

            if($upload){
                $area_file = unserialize($upload->file);
            }else{
                $area_file = [];
            }

            $files = $request->file('files');

            foreach($files as $file){
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];
                $new_filename = date('YmdHis').'-'.$info['original_filename'];
                $file->storeAs('public/upload/'.$select_year.'/'.auth()->user()->code.'/'.$question_id,$new_filename);

                $att['code'] = auth()->user()->code;
                $att['question_id'] = $question_id;
                $att['year'] = $select_year;

                //檢查是否為覆蓋
                if(isset($area_file[$subject][$grade])){
                    $old_file = storage_path('app/public/upload/'.$select_year.'/'.auth()->user()->code.'/'.$question_id.'/'.$area_file[$subject][$grade]);
                    if(file_exists($old_file)){
                        unlink($old_file);
                    }
                }

                $area_file[$subject][$grade] = $new_filename;
            }

            $att['file'] = serialize($area_file);
            if($upload){
                $upload->update($att);
            }else{
                $upload = Upload::create($att);
            }


            write_log('上傳 '.$upload->question->order_by.' 題'.$grade.'年級'.$subject.'檔案',$select_year);
        }

        echo "<body onload='opener.location.reload();window.close();'>";
    }


    public function delete4($file_path,$grade,$subject)
    {
        $file_path = str_replace('&&','/',$file_path);
        $f = explode('/',$file_path);

        $file = storage_path('app/public/upload/'.$file_path);

        $upload = Upload::where('question_id',$f[2])
            ->where('code',auth()->user()->code)
            ->first();
        $area_file = unserialize($upload->file);

        unset($area_file[$subject][$grade]);

        unlink($file);

        if(array_filter($area_file)){
            $att['file'] = serialize($area_file);
            $upload->update($att);
        }else{
            $upload->delete();
        }

        write_log('刪除已上傳的 '.$upload->question->order_by.' 題'.$grade.'年級'.$subject.'檔案',$upload->year);

        return redirect()->route('schools.edit',$f[0]);
    }

    public function upload5($select_year,Question $question)
    {
        $year = Year::where('year',$select_year)->first();

        $year9 = [];
        $year12= [];
        //九年一貫的年級有哪一些
        if(auth()->user()->group_id==1){
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

        }elseif(auth()->user()->group_id==2){
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

        //管理者已建之版本
        $mandarin_books = Book::where('subject','mandarin')
            ->where('disable',null)
            ->get();
        $dialects_books = Book::where('subject','dialects')
            ->where('disable',null)
            ->get();
        $english_books = Book::where('subject','english')
            ->where('disable',null)
            ->get();
        $mathematics_books = Book::where('subject','mathematics')
            ->where('disable',null)
            ->get();
        $life_curriculum_books = Book::where('subject','life_curriculum')
            ->where('disable',null)
            ->get();
        $social_studies_books = Book::where('subject','social_studies')
            ->where('disable',null)
            ->get();
        $science_technology_books = Book::where('subject','science_technology')
            ->where('disable',null)
            ->get();
        $science_books = Book::where('subject','science')
            ->where('disable',null)
            ->get();
        $arts_humanities_books = Book::where('subject','arts_humanities')
            ->where('disable',null)
            ->get();
        $integrative_activities_books = Book::where('subject','integrative_activities')
            ->where('disable',null)
            ->get();
        $technology_books = Book::where('subject','technology')
            ->where('disable',null)
            ->get();
        $health_physical_books = Book::where('subject','health_physical')
            ->where('disable',null)
            ->get();

        $data = [
            'select_year'=>$select_year,
            'question'=>$question,
            'year9'=>$year9,
            'year12'=>$year12,
            'mandarin_books'=>$mandarin_books,
            'dialects_books'=>$dialects_books,
            'english_books'=>$english_books,
            'mathematics_books'=>$mathematics_books,
            'life_curriculum_books'=>$life_curriculum_books,
            'social_studies_books'=>$social_studies_books,
            'science_technology_books'=>$science_technology_books,
            'science_books'=>$science_books,
            'arts_humanities_books'=>$arts_humanities_books,
            'integrative_activities_books'=>$integrative_activities_books,
            'technology_books'=>$technology_books,
            'health_physical_books'=>$health_physical_books,
        ];
        return view('school.upload5',$data);
    }

    public function save5(Request $request)
    {
        $select_year = $request->input('select_year');
        $question_id = $request->input('question_id');

        $book['mandarin'] = $request->input('mandarin_book');
        $book['dialects'] = $request->input('dialects_book');
        $book['english'] = $request->input('english_book');
        $book['mathematics'] = $request->input('mathematics_book');
        $book['life_curriculum'] = $request->input('life_curriculum_book');
        $book['social_studies'] = $request->input('social_studies_book');
        $book['science_technology'] = $request->input('science_technology_book');
        $book['science'] = $request->input('science_book');
        $book['arts_humanities'] = $request->input('arts_humanities_book');
        $book['integrative_activities'] = $request->input('integrative_activities_book');
        $book['technology'] = $request->input('technology_book');
        $book['health_physical'] = $request->input('health_physical_book');

        $att['code'] = auth()->user()->code;
        $att['question_id'] = $question_id;
        $att['year'] = $select_year;
        $att['file'] = serialize($book);
        Upload::create($att);

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function delete5(Upload $upload)
    {
        $upload->delete();
        return redirect()->route('schools.edit',$upload->year);
    }

    public function upload6($select_year,Question $question,$stu_year)
    {
        $data = [
            'select_year'=>$select_year,
            'question'=>$question,
            'stu_year'=>$stu_year
        ];
        return view('school.upload6',$data);
    }

    public function save6(UploadRequest $request)
    {
        $select_year = $request->input('select_year');
        $question_id = $request->input('question_id');
        $stu_year = $request->input('stu_year');
        //處理檔案上傳
        if ($request->hasFile('files')) {
            //先查詢有無上傳過
            $upload = Upload::where('question_id',$question_id)
                ->where('code',auth()->user()->code)
                ->first();
            if($upload){
                $file_array = unserialize($upload->file);
                //刪除已上傳的檔案
                if(isset($file_array[$stu_year])){
                    $old_file = storage_path('app/public/upload/'.$select_year.'/'.auth()->user()->code.'/'.$question_id.'/'.$file_array[$stu_year]);
                    unlink($old_file);
                }
            }else{
                $file_array = [];
            }

            $files = $request->file('files');

            foreach($files as $file){
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];
                $new_filename = date('YmdHis').'-'.$info['original_filename'];
                $file->storeAs('public/upload/'.$select_year.'/'.auth()->user()->code.'/'.$question_id,$new_filename);

                $att['code'] = auth()->user()->code;
                $att['question_id'] = $question_id;
                $att['year'] = $select_year;
                $file_array[$stu_year] = $new_filename;
            }

            $att['file'] = serialize($file_array);

            if($upload){
                $upload->update($att);
            }else{
                $upload = Upload::create($att);
            }
            $cht_stu_year = ['1'=>'一年級','2'=>'二年級','3'=>'三年級','4'=>'四年級','5'=>'五年級','6'=>'六年級','7'=>'七年級','8'=>'八年級','9'=>'九年級'];
            write_log('上傳 '.$upload->question->order_by.' 題 '.$cht_stu_year[$stu_year].' 檔案',$select_year);
        }

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function delete6($file_path,$stu_year)
    {
        $file_path = str_replace('&&','/',$file_path);
        $f = explode('/',$file_path);

        $file = storage_path('app/public/upload/'.$file_path);

        $upload = Upload::where('question_id',$f[2])
            ->where('code',auth()->user()->code)
            ->first();

        $file_array = unserialize($upload->file);
        unset($file_array[$stu_year]);

        if(array_filter($file_array)){
            $att['file'] = serialize($file_array);
            $upload->update($att);
        }else{
            $upload->delete();
        }
        unlink($file);
        $cht_stu_year = ['1'=>'一年級','2'=>'二年級','3'=>'三年級','4'=>'四年級','5'=>'五年級','6'=>'六年級','7'=>'七年級','8'=>'八年級','9'=>'九年級'];
        write_log('刪除已上傳的 '.$upload->question->order_by.' 題 '.$cht_stu_year[$stu_year].' 檔案',$upload->year);

        return redirect()->route('schools.edit',$f[0]);
    }

    public function upload7($select_year,Question $question,$stu_year)
    {
        $data = [
            'select_year'=>$select_year,
            'question'=>$question,
            'stu_year'=>$stu_year
        ];
        return view('school.upload7',$data);
    }

    public function save7(UploadRequest $request)
    {
        $select_year = $request->input('select_year');
        $question_id = $request->input('question_id');
        $stu_year = $request->input('stu_year');
        //處理檔案上傳
        if ($request->hasFile('files')) {
            //先查詢有無上傳過
            $upload = Upload::where('question_id',$question_id)
                ->where('code',auth()->user()->code)
                ->first();
            if($upload){
                $file_array = unserialize($upload->file);
            }else{
                $file_array = [];
            }

            $files = $request->file('files');

            foreach($files as $file){
                $info = [
                    //'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];
                $new_filename = date('YmdHis').'-'.$info['original_filename'];
                $file->storeAs('public/upload/'.$select_year.'/'.auth()->user()->code.'/'.$question_id,$new_filename);

                $att['code'] = auth()->user()->code;
                $att['question_id'] = $question_id;
                $att['year'] = $select_year;
                if(!isset($file_array[$stu_year])){
                    $file_array[$stu_year] = array();
                }
                array_push($file_array[$stu_year],$new_filename);
            }

            $att['file'] = serialize($file_array);

            if($upload){
                $upload->update($att);
            }else{
                $upload = Upload::create($att);
            }
            $cht_stu_year = ['1'=>'一年級','2'=>'二年級','3'=>'三年級','4'=>'四年級','5'=>'五年級','6'=>'六年級','7'=>'七年級','8'=>'八年級','9'=>'九年級'];
            write_log('上傳 '.$upload->question->order_by.' 題 '.$cht_stu_year[$stu_year].' 檔案',$select_year);
        }

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function delete7($file_path,$stu_year)
    {
        $file_path = str_replace('&&','/',$file_path);
        $f = explode('/',$file_path);

        $file = storage_path('app/public/upload/'.$file_path);

        $upload = Upload::where('question_id',$f[2])
            ->where('code',auth()->user()->code)
            ->first();

        $file_array = unserialize($upload->file);
        foreach($file_array[$stu_year] as $k=>$v){
            if($v==$f[3]){
                unset($file_array[$stu_year][$k]);
            }
        }

        if(array_filter($file_array)){
            $att['file'] = serialize($file_array);
            $upload->update($att);
        }else{
            $upload->delete();
        }
        unlink($file);
        $cht_stu_year = ['1'=>'一年級','2'=>'二年級','3'=>'三年級','4'=>'四年級','5'=>'五年級','6'=>'六年級','7'=>'七年級','8'=>'八年級','9'=>'九年級'];
        write_log('刪除已上傳的 '.$upload->question->order_by.' 題 '.$cht_stu_year[$stu_year].' 檔案',$upload->year);

        return redirect()->route('schools.edit',$f[0]);
    }


    public function upload8($select_year,Question $question)
    {
        $data = [
            'select_year'=>$select_year,
            'question'=>$question,
        ];
        return view('school.upload8',$data);
    }

    public function save8(UploadRequest $request)
    {
        $question_id = $request->input('question_id');
        $select_year = $request->input('select_year');

        $att['file'] = $request->input('want_date');
        $att['code'] = auth()->user()->code;
        $att['question_id'] = $question_id;
        $att['year'] = $select_year;

        $upload = Upload::create($att);

        write_log('已填寫 '.$upload->question->order_by.' 題日期',$select_year);

        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function delete8(Upload $upload)
    {
        $select_year = $upload->year;
        write_log('刪除 '.$upload->question->order_by.' 題日期',$select_year);
        $upload->delete();

        return redirect()->route('schools.edit',$select_year);
    }

    public function submit(Request $request)
    {
        $select_year = $request->input('select_year');
        $action = $request->input('action');
        $course = Course::where('year',$select_year)
            ->where('school_code',auth()->user()->code)
            ->first();
        if($action == "edit"){
            if($course->first_result1==null){
                $att['first_result1'] = "submit";
            }
            if(($course->first_result1=="back" or $course->first_result1=="late") and $course->first_result2==null){
                $att['first_result2'] = "submit";
            }
            if($course->first_result2=="back"){
                $att['first_result3'] = "submit";
            }
        }elseif($action == "edit2"){
            $att['special_result'] = "submit";
        }
        $course->update($att);
        return redirect()->route('schools.index');
    }

    public function show_special($select_year)
    {
        $special_questions = Question::where('year',$select_year)
            ->where('g_s','2')
            ->orderBy('order_by')
            ->get();
        $data = [
            'special_questions'=>$special_questions,
        ];
        return view('school.show_special',$data);
    }

    public function show_all($select_year)
    {
        $course = Course::where('school_code',auth()->user()->code)
            ->where('year',$select_year)
            ->first();
        $questions = Question::where('year',$select_year)
            ->orderBy('order_by')
            ->get();
        $data = [
            'questions'=>$questions,
            'course'=>$course,
        ];
        return view('school.show_all',$data);
    }

}
