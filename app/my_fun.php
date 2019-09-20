<?php
//顯示某目錄下的檔案
if (! function_exists('get_files')) {
    function get_files($folder){
        $files = [];
        $i=0;
        if (is_dir($folder)) {
            if ($handle = opendir($folder)) {
                while (false !== ($name = readdir($handle))) {
                    if ($name != "." && $name != "..") {
                        //去除掉..跟.
                        $files[$i] = $name;
                        $i++;
                    }
                }
                closedir($handle);
            }
        }
        return $files;
    }
}

//刪除某目錄所有檔案
if (! function_exists('del_folder')) {
    function del_folder($folder){
        if (is_dir($folder)) {
            if ($handle = opendir($folder)) { //開啟現在的資料夾
                while (false !== ($file = readdir($handle))) {
                    //避免搜尋到的資料夾名稱是false,像是0
                    if ($file != "." && $file != "..") {
                        //去除掉..跟.
                        unlink($folder.'/'.$file);
                    }
                }
                closedir($handle);
            }
            rmdir($folder);
        }
    }
}

//檢查可登入的
function check_login($n){
    if($n==="教學組長") return true;
    if($n==="教師兼教學組長") return true;
    if($n==="教學註冊組長") return true;
    if($n==="研發組長") return true;
    if($n==="課程研發組長") return true;
    if($n==="教學研發組長") return true;
    if($n==="資訊組長") return true;
    if($n==="教務組長") return true;
    if($n==="教務主任") return true;
    if($n==="教導主任") return true;
    if($n==="輔導主任") return true;
    if($n==="輔導室主任") return true;
    if($n==="特教組長") return true;
    if($n==="資料組長") return true;
    if($n==="校長") return true;

    return false;
}

//寫入log
if(! function_exists('write_log')){
    function write_log($event,$year){
        $att['year'] = $year;
        $att['school_code'] = auth()->user()->code;
        $att['event'] = $event;
        $att['user_id'] = auth()->user()->id;
        \App\Log::create($att);
    }
}

if (! function_exists('cht2num')) {
    function cht2num($c){
        $cht = [
            '一'=>'1',
            '二'=>'2',
            '三'=>'3',
            '四'=>'4',
            '五'=>'5',
            '六'=>'6',
            '七'=>'7',
            '八'=>'8',
            '九'=>'9',
        ];
        return $cht[$c];
    }
}
