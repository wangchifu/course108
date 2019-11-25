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
if (! function_exists('deldir')) {
    function deldir($dir) {
        if(is_dir($dir)){
            $dh = opendir($dir);
            while ($file = readdir($dh)) {
                if($file != "." && $file!="..") {
                    $fullpath = $dir."/".$file;
                    if(!is_dir($fullpath)) {
                        unlink($fullpath);
                    } else {
                        deldir($fullpath);
                    }
                }
            }
            closedir($dh);

            //删除当前文件夹：
            if(rmdir($dir)) {
                return true;
            } else {
                return false;
            }
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

function check_in_date($select_year){
    $year = \App\Year::where('year',$select_year)->first();
    $step11 = str_replace('-','',$year->step1_date1);
    $step12 = str_replace('-','',$year->step1_date2);
    if(date('Ymd') >= $step11 and date('Ymd') <= $step12){
        $check = true;
    }else{
        $check = false;
    }
    return $check;
}

function check_date($select_year,$action){
    $year = \App\Year::where('year',$select_year)->first();
    $words = null;
    $today = date('Ymd');
    if($action==1){
        $d1 = str_replace('-','',$year->step1_date1);
        $d2 = str_replace('-','',$year->step1_date2);
    }
    if($action==2){
        $d1 = str_replace('-','',$year->step2_date1);
        $d2 = str_replace('-','',$year->step2_date2);
    }
    if($action=="2_1"){
        $d1 = str_replace('-','',$year->step2_1_date1);
        $d2 = str_replace('-','',$year->step2_1_date2);
    }
    if($action=="2_2"){
        $d1 = str_replace('-','',$year->step2_2_date1);
        $d2 = str_replace('-','',$year->step2_2_date2);
    }
    if($action==3){
        $d1 = str_replace('-','',$year->step3_date1);
        $d2 = str_replace('-','',$year->step3_date2);
    }
    if($action==4){
        $d1 = str_replace('-','',$year->step4_date1);
        $d2 = str_replace('-','',$year->step4_date2);
    }

    $w = [
        '1'=>'階段1：學校上傳',
        '2'=>'階段2：初審作業',
        '2_1'=>'階段2_1：依初審後再傳',
        '2_2'=>'階段2_2：初審後，三傳',
        '3'=>'階段3：複審作業',
        '4'=>'查詢',
    ];

    if($today < $d1 or $today >$d2){
        $words = $w[$action]." 開放時間為 ".$d1." 到 ".$d2;
    }
    return $words;
}

if (! function_exists('usersId2Names')) {
    function usersId2Names(){
        $users = \App\User::all();
        foreach($users as $user){
            $users2Names[$user->id] = $user->name;
        }
        return $users2Names;
    }
}

//發email
if(! function_exists('send_mail')){
    function send_mail($to,$subject,$body)
    {
        $data = array("subject"=>$subject,"body"=>$body,"receipt"=>"{$to}");
        $data_string = json_encode($data);
        $ch = curl_init('https://school.chc.edu.tw/api/mail');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string),
                'AUTHKEY: #chc7237182#')
        );
        $result = curl_exec($ch);
        $obj = json_decode($result,true);
        if( $obj["success"] == true) {
            //echo "<body onload=alert('已mail通知')>";
        };


    }
}

if(! function_exists('line_to')){
    function line_to($token,$message){
        define('LINE_API_URL'  ,"https://notify-api.line.me/api/notify");
        define('LINE_API_TOKEN',$token);

        function post_message($message){

            $data = array(
                "message" => $message
            );
            $data = http_build_query($data, "", "&");

            $options = array(
                'http'=>array(
                    'method'=>'POST',
                    'header'=>"Authorization: Bearer " . LINE_API_TOKEN . "\r\n"
                        . "Content-Type: application/x-www-form-urlencoded\r\n"
                        . "Content-Length: ".strlen($data)  . "\r\n" ,
                    'content' => $data
                )
            );
            $context = stream_context_create($options);
            $resultJson = file_get_contents(LINE_API_URL,FALSE,$context );
            $resutlArray = json_decode($resultJson,TRUE);
            if( $resutlArray['status'] != 200)  {
                return false;
            }
            return true;
        }
        post_message($message);
    }
}

if(! function_exists('get_line_token')){
    function get_line_token($authorize_code){
        define('LINE_OAUTH_TOKEN_URL'  ,"https://notify-bot.line.me/oauth/token");
        $line = config('course.line');

        $data = array(
            "grant_type" => "authorization_code",
            "code"=>$authorize_code,
            "redirect_uri"=>"https://".$_SERVER['HTTP_HOST']."/callback",
            "client_id"=>$line['client_id'],
            "client_secret"=>$line['client_secret'],
        );
        $data = http_build_query($data, "", "&");
        $options = array(
            'http'=>array(
                'method'=>'POST',
                'header'=>"Content-Type: application/x-www-form-urlencoded\r\n"
                    . "Content-Length: ".strlen($data)  . "\r\n" ,
                'content' => $data
            )
        );
        $context = stream_context_create($options);
        $resultJson = file_get_contents(LINE_OAUTH_TOKEN_URL,FALSE,$context );
        $resutlArray = json_decode($resultJson,TRUE);
        if($resutlArray['status'] == 200){
            return $resutlArray['access_token'];
        }else{
            return null;
        }
    }
}
