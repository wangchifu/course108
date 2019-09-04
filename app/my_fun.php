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
