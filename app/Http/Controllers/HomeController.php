<?php

namespace App\Http\Controllers;

use App\Message;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function admin()
    {
        return view('admin');
    }

    public function reset_pwd()
    {
        return view('reset_pwd');
    }

    public function update_pwd(Request $request)
    {
        $request->validate([
            'password1'=>'required|same:password2'
        ]);
        if(password_verify($request->input('password0'), auth()->user()->password)){
            $att['password'] = bcrypt($request->input('password1'));
            User::where('id',auth()->user()->id)->update($att);
            return redirect()->route('index');
        }else{
            return back()->withErrors('舊密碼錯誤');
        }

    }

    public function notify()
    {
        $groups = config('course.groups');
        $schools = config('course.schools');
        $messages = Message::where('from_user_id',auth()->user()->id)
            ->orWhere(function($q){
                $q->where('for_user_id',auth()->user()->id)
                    ->orWhere('for_school_code',auth()->user()->code);
            })->orderBy('created_at','DESC')
            ->get();

        $data = [
            'groups'=>$groups,
            'schools'=>$schools,
            'messages'=>$messages,
        ];
        return view('notify',$data);
    }

    public function email_store(Request $request)
    {
        $request->validate([
            'email' => 'email',
        ]);

        $att['email'] = $request->input('email');
        $user = User::find(auth()->user()->id);
        $user->update($att);
        return redirect()->route('index');
    }

    public function callback(Request $request)
    {
        if($request->input('error')=="access_denied"){
            echo "<body onload='opener.location.reload();window.close();'>";
        }else{
            $code = ($request->input('code'));
            $token = get_line_token($code);
            if($token){
                $att['access_token'] = $token;
                $user = User::find(auth()->user()->id);
                $user->update($att);

            }
        }
        echo "<body onload='opener.location.reload();window.close();'>";
    }

    public function cancel()
    {
        $att['access_token'] = null;
        $user = User::find(auth()->user()->id);
        $user->update($att);

        return redirect()->route('schools.index');
    }

    public function message(Request $request)
    {
        $groups = config('course.groups');
        $school_code = $request->input('school_code');
        $for_user_id = $request->input('for_user_id');
        $schools = config('course.schools');
        if($for_user_id){
            $for_user = User::find($for_user_id);
        }else{
            $for_user = "";
        }

        $data = [
            'groups'=>$groups,
            'school_code'=>$school_code,
            'for_user_id'=>$for_user_id,
            'schools'=>$schools,
            'for_user'=>$for_user,
        ];

        return view('message',$data);
    }

    public function message_store(Request $request)
    {
        $att['for_school_code'] = $request->input('for_school_code');
        $att['for_user_id'] = $request->input('for_user_id');
        $att['from_user_id'] = auth()->user()->id;
        $att['message'] = $request->input('message');
        Message::create($att);

        return redirect()->route('notify');
    }
}
