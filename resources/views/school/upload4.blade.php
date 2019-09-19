@extends('layouts.master_clean')
@section('title','上傳檔案 | ')
@section('content')
@include('layouts.form_errors')
{{ Form::open(['route'=>'schools.save4','method'=>'post','files'=>true]) }}
<table class="table">
    <thead>
    <tr>
        <th>
            題目序號
        </th>
        <th>
            年級
        </th>
        <th>
            科目
        </th>
        <th>
            選擇檔案
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
        <th>
            {{ $grade }}年級
        </th>
        <th>
            {{ $subjects[$subject] }}
        </th>
        <td>
            <input type="file" name="files[]" required>
        </td>
        <td>
            <button type="submit" onclick="return confirm('確定？')">上傳單檔</button>
        </td>
    </tr>
    </tbody>
</table>
<input type="hidden" name="question_id" value="{{ $question->id }}">
<input type="hidden" name="select_year" value="{{ $select_year }}">
<input type="hidden" name="grade" value="{{ $grade }}">
<input type="hidden" name="subject" value="{{ $subject }}">
{{ Form::close() }}
@endsection
