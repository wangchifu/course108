<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\UploadRequest;
use Illuminate\Http\Request;

class FileController extends Controller
{
    //下載已上傳之檔案
    public function getFile($file)
    {
        $file = str_replace('&','/',$file);
        $file = storage_path('app/public/'.$file);
        return response()->download($file);
    }

    //不要強制下載，要線上打開
    public function open($file_path)
    {
        $file_path = str_replace('&&','/',$file_path);
        $file = storage_path('app/public/upload/'.$file_path);

        return response()->file($file);
    }

/**
    //不要強制下載，要線上打開
    public function open($file_path)
    {
        $file_path = str_replace('&','/',$file_path);
        $file = storage_path('app/public/upload/'.$file_path);
        $file .= ".pdf";

        return response()->file($file);
    }

    //下載指定年度學校的課程計畫
    public function download($year,$school_code,$file_name)
    {
        $course = Course::where('year',$year)
            ->where('school_code',auth()->user()->code)
            ->first();
        if($course->open == 1 or $course->school_code == auth()->user()->code){
            $file = storage_path('app/public/upload/'.$year.'/'.$school_code.'/'.$file_name.".pdf");
            return response()->download($file);
        }else{
            return back();
        }

    }

    //下載指定路徑
    public function download2($file_path)
    {
        $file_path = str_replace('&','/',$file_path);
        $file = storage_path('app/public/upload/'.$file_path);
        return response()->download($file);
    }

    //刪除課程計畫檔案
    public function delfile($year,$school_code,$file_name)
    {
        if($school_code != auth()->user()->code){
            return back()->withErrors('你想做什麼？');
        }

        $course = Course::where('year',$year)
            ->where('school_code',auth()->user()->code)
            ->first();
        if($course->school_code == auth()->user()->code){
            $file = storage_path('app/public/upload/'.$year.'/'.$school_code.'/'.$file_name.".pdf");
            if(file_exists($file)){
                unlink($file);
            }
            $att[$file_name] = null;
            $course->update($att);
        }else{
            return back();
        }
        if(substr($file_name,0,4) == "c6_"){
            $file_name = str_replace('c6_','c5_3_',$file_name);
        }

        if(substr($file_name,0,2) == "c7"){
            $file_name = str_replace('c7','c6',$file_name);
        }

        if(substr($file_name,0,3) == "c10"){
            $file_name = str_replace('c10','c9',$file_name);
        }

        if(substr($file_name,0,3) == "c11"){
            $file_name = str_replace('c11','c10',$file_name);
        }

        if(substr($file_name,0,3) == "c12"){
            $file_name = str_replace('c12','c11',$file_name);
        }

        if(substr($file_name,0,3) == "c13"){
            $file_name = str_replace('c13','c12',$file_name);
        }
        write_log('刪除 '.$file_name.' 檔案',$year);

        return redirect('schools/'. $year.'/edit');
    }

    public function delfile2($file_path)
    {
        $file_path = str_replace('&','/',$file_path);
        $file = storage_path('app/public/upload/'.$file_path);

        if(file_exists($file)){
            unlink($file);
        }

        $f = explode('/',$file_path);
        if(substr($f[2],0,2)=="c9"){
            $c = str_replace('c9','c8',$f[2]);
        }

        if(substr($f[2],0,3)=="c14"){
            $c = str_replace('c14','c13',$f[2]);
        }
        write_log('刪除 '.$c." ".$f[3].' 檔案',$f[0]);

        return back();
    }
 * */
}
