@extends('layouts.master_clean')

@section('title','修改 | ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table">
                {{ Form::open(['route'=>['questions.update_part',$part->id],'method'=>'post']) }}
                <tr>
                    <td width="120">
                        <label>序號</label>
                    </td>
                    <td colspan="2">
                        {{ Form::select('order_by',$part_order_by,$part->order_by,['required'=>'required']) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>名稱</label>
                    </td>
                    <td>
                        {{ Form::text('title',$part->title,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入名稱','required'=>'required']) }}
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm" onclick="return confirm('確定嗎？')">儲存修改</button>
                    </td>
                </tr>
                <input type="hidden" name="year" value="{{ $select_year }}">
                {{ Form::close() }}
            </table>
        </div>
    </div>
@endsection
