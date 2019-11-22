<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.glogin');
    }

    public function auth(Request $request)
    {
        //檢驗gsuite帳密
        $data = array("email"=>$request->input('username'),"password"=>$request->input('password'));
        $data_string = json_encode($data);
        $ch = curl_init('https://school.chc.edu.tw/api/auth');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);
        $obj = json_decode($result,true);

        if($obj['success']) {
            //非教職員，即跳開
            if($obj['kind'] != "教職員"){
                return back()->withErrors('並非教職員');
            }

            if(!check_login($obj['title'])){
                return back()->withErrors('並非相關業務人員');
            }

            //非國中小端，即跳開
            $school = ['5','6','7','8'];
            //完全中學
            $per_j_school = ['071311','071317','071318','074308','074313','074323','074328','074339'];
            if(!in_array(substr($obj['code'],3,1),$school)
                and !in_array($obj['code'],$per_j_school))
            {
                return back()->withErrors('並非國中小端');
            }


            //是否已有此帳號
            $u = explode('@',$request->input('username'));
            $username = $u[0];

            $user = User::where('username',$username)
                ->where('login_type','gsuite')
                ->first();

            if(empty($user)){
                //無使用者，即建立使用者資料
                $att['username'] = $username;
                $att['name'] = $obj['name'];
                $att['password'] = bcrypt($request->input('password'));
                $att['code'] = $obj['code'];
                $att['school'] = $obj['school'];
                $att['kind'] = $obj['kind'];
                $att['title'] = $obj['title'];
                $att['login_type'] = "gsuite";
                $per_e_school = ['6','7','8'];
                if(in_array(substr($obj['code'],3,1),$per_e_school)){
                    $att['group_id'] = "1";
                }else{
                    $att['group_id'] = "2";
                }

                User::create($att);

            }else{
                //有此使用者，即更新使用者資料
                $att['name'] = $obj['name'];
                $att['password'] = bcrypt($request->input('password'));
                $att['code'] = $obj['code'];
                $att['school'] = $obj['school'];
                $att['kind'] = $obj['kind'];
                $att['title'] = $obj['title'];
                $per_e_school = ['6','7','8'];
                if(in_array(substr($obj['code'],3,1),$per_e_school)){
                    $att['group_id'] = "1";
                }else{
                    $att['group_id'] = "2";
                }
                $user->update($att);
            }


            //登入
            if(Auth::attempt(['username' => $username,
                'password' => $request->input('password')])){
                //return redirect()->route('index');
                return redirect()->route('schools.index');
            }
        }else{
            return back()->withErrors('GSuite認證錯誤');
        };
    }
}
