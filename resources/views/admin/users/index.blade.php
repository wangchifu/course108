@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title','使用者 | ')

@section('content')
    <?php
        for($i=1;$i<8;$i++){
            $active[$i] = null;
        }
        $active[1] = "active";
    ?>
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('admin.side',['active'=>$active])
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5>
                        <table>
                            <tr>
                                <td>
                                    <img src="{{ asset('images/group.svg') }}" height="24">
                                </td>
                                <td>
                                    選擇群組：
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                {{ Form::open(['route'=>'users.index','method'=>'post']) }}
                                                {{ Form::select('group_id',$groups,$group_id,['onchange'=>'submit()']) }}
                                                {{ Form::close() }}
                                            </td>
                                            <td>
                                                <form action="{{ route('users.search') }}" method="post">
                                                    @csrf
                                                    <input type="text" name="target" required placeholder="輸入名稱">
                                                    <button type="submit">搜尋</button>
                                                </form>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </h5>
                </div>
                <div class="card-body">
                    @if($group_id !="1" and $group_id != "2")
                        <a href="{{ route('users.create',$group_id) }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> 新增{{ $groups[$group_id] }}</a>
                    @endif
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>
                                帳號
                            </th>
                            <th>
                                姓名
                            </th>
                            <th>
                                職稱
                            </th>
                            <th>
                                email
                            </th>
                            <th>
                                動作
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>
                                    @if($user->disable)
                                        <i class="fas fa-times-circle text-danger"></i>
                                    @endif
                                    {{ $user->username }}
                                    @if($user->disable)
                                        <span class="text-danger">(已停用)</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->school }}
                                    {{ $user->title }}
                                </td>
                                <td>
                                    @if($user->email)
                                    <span class="badge badge-secondary" data-container="body" data-toggle="popover{{ $user->id }}" data-placement="top" data-content="{{ $user->email }}">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('sims.impersonate',$user->id) }}" onclick="return confirm('確定模擬登入？')">
                                        <span class="badge badge-warning">模擬</span></a>
                                    @if($user->disable)
                                        <a href="#" onclick="if(confirm('確定啟用帳號 {{ $user->username }} 嗎?')) getElementById('able{{ $user->id }}').submit();else return false">
                                            <span class="badge badge-success">啟用</span>
                                        </a>
                                        {{ Form::open(['route' => ['users.able',$user->id], 'method' => 'patch','id'=>'able'.$user->id]) }}
                                        {{ Form::close() }}
                                    @else
                                        @if($group_id=="3" or $group_id=="4" or $group_id=="5" or $group_id=="9")
                                            <a href="{{ route('users.edit',$user->id) }}"><span class="badge badge-primary">編輯</span></a>
                                            <a href="{{ route('users.reset',$user->id) }}" onclick="return confirm('確定重設密碼為 {{ env('DEFAULT_PWD') }}？')"><span class="badge badge-info">還原</span></a>
                                        @endif
                                        <a href="#" onclick="if(confirm('確定停用帳號 {{ $user->username }} 嗎?')) getElementById('disable{{ $user->id }}').submit();else return false">
                                            <span class="badge badge-danger">停用</span>
                                        </a>
                                        {{ Form::open(['route' => ['users.disable',$user->id], 'method' => 'patch','id'=>'disable'.$user->id]) }}
                                        {{ Form::close() }}
                                    @endif
                                </td>
                            </tr>
                            <script>
                                $(function () {
                                    $('[data-toggle="popover{{ $user->id }}"]').popover()
                                })
                            </script>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
