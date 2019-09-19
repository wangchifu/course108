<?php

namespace App\Http\Controllers;

use App\Book;
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
        }

        $data = [
            'year_items'=>$year_items,
            'select_year'=>$select_year,
            'part_order_by'=>$part_order_by,
            'type_items'=>$type_items,
            'g_s_items'=>$g_s_items,
            'parts'=>$parts,
            'year'=>$year,
        ];
        return view('school.index',$data);
    }

    public function edit($select_year)
    {
        $year = Year::where('year',$select_year)->first();
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

}
