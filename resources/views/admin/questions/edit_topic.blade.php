@extends('layouts.master_clean')

@section('title','修改 | ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table">
                {{ Form::open(['route'=>['questions.update_topic',$topic->id],'method'=>'post']) }}
                <tr>
                    <td width="120">
                        <label>所屬「部分」</label>
                    </td>
                    <td colspan="2">
                        {{ Form::select('part_id',$part_items,null,['required'=>'required']) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        大題號
                    </td>
                    <td colspan="2">
                        {{ Form::text('order_by',$topic->order_by,['id'=>'order_by', 'placeholder' => '請輸入整數','required'=>'required','maxlength'=>'2']) }}
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>名稱</label>
                    </td>
                    <td>
                        {{ Form::text('title',$topic->title,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入名稱','required'=>'required']) }}
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
