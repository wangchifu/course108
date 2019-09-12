@extends('layouts.master_clean')
@section('title','上傳檔案 | ')
@section('content')
@include('layouts.form_errors')
{{ Form::open(['route'=>'schools.save2','method'=>'post','files'=>true]) }}
<table class="table">
    <thead>
    <tr>
        <th>
            題目序號
        </th>
        <th>
            選擇檔案(用 Ctrl 可多選)
        </th>
        <th width="200">
            動作<br>
            <small class="text-secondary">(限20MB內PDF檔)</small>
        </th>
    </tr>
    </thead>
    <tbody>
    <tr>

        <td>
            {{$question->order_by}} {{ \Illuminate\Support\Str::limit($question->title,30) }}
        </td>
        <td>
            <input type="file" name="files[]" required multiple>
        </td>
        <td>
            <button type="submit" onclick="return confirm('確定？')">上傳多檔</button>
        </td>
    </tr>
    </tbody>
</table>
<input type="hidden" name="question_id" value="{{ $question->id }}">
<input type="hidden" name="select_year" value="{{ $select_year }}">
{{ Form::close() }}
@endsection
