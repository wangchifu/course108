<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $group_id = ($request->input('group_id'))?$request->input('group_id'):'0';
        $groups = config('course.groups');
        $groups[0]="--請選擇--";
        ksort($groups);
        $users = User::where('group_id',$group_id)
            ->orderBy('disable')
            ->get();

        $data = [
            'group_id'=>$group_id,
            'groups'=>$groups,
            'users'=>$users,
        ];
        return view('admin.users.index',$data);
    }

    public function create($group_id)
    {
        $groups = config('course.groups');
        $data = [
            'group_id'=>$group_id,
            'groups'=>$groups,
        ];
        return view('admin.users.create',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'=>'required|regex:/^[a-zA-Z]{1}/|min:4|unique:users,username',
        ]);

        $att['username'] = $request->input('username');
        $att['name'] = $request->input('name');
        $att['title'] = $request->input('title');
        $att['email'] = $request->input('email');
        $att['password'] = bcrypt(env('DEFAULT_PWD'));
        $att['group_id'] = $request->input('group_id');
        if($att['group_id']==9) $att['admin'] =1 ;
        $att['login_type'] = "local";

        User::create($att);

        return redirect()->route('users.index',['group_id'=>$att['group_id']]);
    }

    public function edit(User $user)
    {
        $groups = config('course.groups');

        $data = [
            'user'=>$user,
            'groups'=>$groups,
        ];
        return view('admin.users.edit',$data);
    }

    public function update(Request $request, User $user)
    {

        $att['name'] = $request->input('name');
        $att['title'] = $request->input('title');
        $att['email'] = $request->input('email');

        $user->update($att);

        return redirect()->route('users.index',['group_id'=>$user->group_id]);
    }

    public function disable(User $user)
    {
        $att['disable'] = 1;
        $user->update($att);
        return redirect()->route('users.index',['group_id'=>$user->group_id]);
    }

    public function able(User $user)
    {
        $att['disable'] = null;
        $user->update($att);
        return redirect()->route('users.index',['group_id'=>$user->group_id]);
    }

    public function reset(User $user)
    {
        $att['password'] = bcrypt(env('DEFAULT_PWD'));
        $user->update($att);
        return redirect()->route('users.index',['group_id'=>$user->group_id]);
    }

    public function search(Request $request)
    {
        $target = $request->input('target');
        $users = User::where('school', 'like', '%' . $target . '%')
            ->orWhere(function($q) use ($target){
                $q->where('name','like','%' . $target . '%');
            })
            ->orderBy('group_id')
            ->get();

        $group_id = ($request->input('group_id'))?$request->input('group_id'):'0';
        $groups = config('course.groups');
        $groups[0]="--請選擇--";
        ksort($groups);

        $data = [
            'group_id'=>$group_id,
            'groups'=>$groups,
            'users'=>$users,
        ];
        return view('admin.users.index',$data);
    }
}
