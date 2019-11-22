@extends('layouts.master_clean')
@section('title','指定審「身障類」委員 | ')
@section('content')
@include('layouts.form_errors')
<h4>
    {{ $question->title }}
</h4>
{{ Form::open(['route'=>'reviews.special_user_store','method'=>'post']) }}
<table class="table table-striped">
    <tr>
        <th>
            學年度
        </th>
        <th>
            學校
        </th>
        <th>
            審題委員
        </th>
        <th>
            動作
        </th>
    </tr>
    <tr>
        <td>
            {{ $select_year }}學年
        </td>
        <td>
            {{ $schools[$school_code] }} <small>({{ $school_code }})</small>
        </td>
        <td>
            {{ Form::select('user_id', $users,null, ['class' => 'form-control','required'=>'required', 'placeholder' => '--']) }}
        </td>
        <td>
            <button type="submit" onclick="confirm('確定？')">儲存委員</button>
        </td>
    </tr>
</table>
<input type="hidden" name="select_year" value="{{ $select_year }}">
<input type="hidden" name="school_code" value="{{ $school_code }}">
<input type="hidden" name="question_id" value="{{ $question->id }}">
{{ Form::close() }}
@endsection
