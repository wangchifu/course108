@extends('layouts.master_clean')
@section('title','上傳檔案 | ')
@section('content')
@include('layouts.form_errors')
{{ Form::open(['route'=>'schools.save5','method'=>'post']) }}
<table>
    <tr valign="top">
        @if(auth()->user()->group_id=="1")
            <td valign="top">
                @if(!empty($year12))
                    <strong>國小十二年國教課程</strong>
                    @include('school.book_e12')
                @endif
            </td>
            <td>
                　
            </td>
            <td>
                @if(!empty($year9))
                    <strong>國小九年一貫課程</strong>
                    @include('school.book_e9')
                @endif
            </td>
        @elseif(auth()->user()->group_id=="2")
            <td valign="top">
                @if(!empty($year12))
                    <strong>國中十二年國教課程</strong>
                    @include('school.book_j12')
                @endif
            </td>
            <td>
                　
            </td>
            <td>
                @if(!empty($year9))
                    <strong>國中九年一貫課程</strong>
                    @include('school.book_j9')
                @endif
            </td>
        @endif
    </tr>
</table>
<input type="hidden" name="question_id" value="{{ $question->id }}">
<input type="hidden" name="select_year" value="{{ $select_year }}">
<button onclick="return confirm('確定？')">送出儲存</button>
{{ Form::close() }}
@endsection
