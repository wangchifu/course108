@extends('layouts.master_clean')
@section('title','上傳檔案 | ')
@section('content')
@include('layouts.form_errors')
{{ Form::open(['route'=>'schools.save7','method'=>'post','files'=>true]) }}
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
        <td>
            <?php
                $cht_stu_year = ['1'=>'一年級','2'=>'二年級','3'=>'三年級','4'=>'四年級','5'=>'五年級','6'=>'六年級','7'=>'七年級','8'=>'八年級','9'=>'九年級']
            ?>
            {{ $cht_stu_year[$stu_year] }}
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
<input type="hidden" name="stu_year" value="{{ $stu_year }}">
{{ Form::close() }}
@endsection
