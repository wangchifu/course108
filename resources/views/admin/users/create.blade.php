@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title','新增 | ')

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
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">使用者管理</a></li>
                    <li class="breadcrumb-item active" aria-current="page">新增使用者</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    <h5>
                        <img src="{{ asset('images/followers.svg') }}" height="24">
                        新增{{ $groups[$group_id] }}
                    </h5>
                </div>
                <div class="card-body">
                    @include('layouts.form_errors')
                    {{ Form::open(['route'=>'users.store','method'=>'post']) }}
                    <table cellpadding="5">
                        <tr>
                            <td>
                                <label for="username"><strong>帳號*</strong></label>
                            </td>
                            <td>
                                {{ Form::text('username',null,['id'=>'username','class' => 'form-control','required'=>'required']) }}
                            </td>
                            <td>
                                <small>(四碼以上，首字英文)</small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="username"><strong>密碼</strong></label>
                            </td>
                            <td>
                                demo1234
                            </td>
                            <td>
                                <small>(請提醒登入後立即更換)</small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="name"><strong>姓名*</strong></label>
                            </td>
                            <td>
                                {{ Form::text('name',null,['id'=>'name','class' => 'form-control','required'=>'required']) }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="title"><strong>職稱*</strong></label>
                            </td>
                            <td>
                                {{ Form::text('title',null,['id'=>'title','class' => 'form-control','required'=>'required']) }}
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="email">電子信箱</label>
                            </td>
                            <td colspan="2">
                                {{ Form::email('email',null,['id'=>'email','class' => 'form-control']) }}
                            </td>
                        </tr>
                    </table>
                    <div class="form-group">
                        <a href="#" class="btn btn-secondary btn-sm" onclick="history.back();"><i class="fas fa-backward"></i> 返回</a>
                        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('確定儲存？')">
                            <i class="fas fa-save"></i> 儲存設定
                        </button>
                    </div>
                    <input type="hidden" name="group_id" value="{{ $group_id }}">
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
