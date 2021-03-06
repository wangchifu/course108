@extends('layouts.master_clean')
@section('title','依委員選擇 | ')
@section('content')
@include('layouts.form_errors')
<h4>
    {{ $question->order_by }}：{{ $question->title }}
</h4>
{{ Form::open(['route'=>'reviews.special_by_user_store','method'=>'post']) }}
<table class="table table-striped">
    <tr>
        <th>
            學年度
        </th>
        <th>
            審題委員
        </th>
        <th>
            學校 <label><input type="checkbox" id="checkAll"/> 全選</label>
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
        {{ Form::select('user_id',$users,null,['placeholder'=>'--請選擇--','required'=>'required']) }}
        <td>
            <table border="1">
                @foreach($schools as $k=>$v)
                    <p><input type="checkbox" id="s{{ $k }}" name="s[{{ $k }}]"> <label for="s{{ $k }}">{{ $v }}</label></p>
                @endforeach
            </table>
        </td>
        <td>
            <button type="submit" onclick="confirm('確定？')">儲存</button>
        </td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>
            <button type="submit" onclick="confirm('確定？')">儲存</button>
        </td>
    </tr>
</table>
<input type="hidden" name="select_year" value="{{ $select_year }}">
<input type="hidden" name="question_id" value="{{ $question->id }}">
{{ Form::close() }}
<script>
    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
    });
</script>
@endsection
