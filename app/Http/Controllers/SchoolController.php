<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadRequest;
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
        $data = [
            'part_order_by'=>$part_order_by,
            'type_items'=>$type_items,
            'g_s_items'=>$g_s_items,
            'parts'=>$parts,
            'year'=>$year,
            'questions'=>$questions,
        ];
        return view('school.edit',$data);
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
        if ($request->hasFile('file')) {
            //先刪除已經有的
            $upload = Upload::where('question_id',$question_id)
                ->where('code',auth()->user()->code)
                ->first();
            if($upload){
                $old_file = storage_path('app/public/upload/'.$select_year.'/'.auth()->user()->code.'/'.$question_id.'/'.$upload->file);
                unlink($old_file);
                $upload->delete();
            }

            $file = $request->file('file');
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
                $att['file'] = $new_filename;
                Upload::create($att);
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
        return redirect()->route('schools.edit',$f[0]);
    }
}
