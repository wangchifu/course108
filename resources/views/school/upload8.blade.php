@extends('layouts.master_clean')
@section('title','填入日期 | ')
@section('content')
@include('layouts.form_errors')
{{ Form::open(['route'=>'schools.save8','method'=>'post','files'=>true]) }}
<table class="table">
    <thead>
    <tr>
        <th>
            題目序號
        </th>
        <th>
            日期
        </th>
        <th width="200">
            動作
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>

        <td>
            {{$question->order_by}} {{ \Illuminate\Support\Str::limit($question->title,30) }}
        </td>
        <td>
            <input type="text" name="want_date" maxlength="10" placeholder="十碼日期，如：2019-08-15" class="form-control" required>
        </td>
        <td>
            <button type="submit" onclick="return confirm('確定？')">填入日期</button>
        </td>
    </tr>
    </tbody>
</table>
<input type="hidden" name="question_id" value="{{ $question->id }}">
<input type="hidden" name="select_year" value="{{ $select_year }}">
{{ Form::close() }}
@endsection
