@extends('layouts.master_clean')

@section('title','修改 | ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <table class="table">
                <table class="table">
                    {{ Form::open(['route'=>['questions.update_question',$question->id],'method'=>'post']) }}
                    <?php
                    $type_items = ['1'=>'單檔','2'=>'多檔','3'=>'年級科目節數','4'=>'年級科目單檔','5'=>'年級科目版本','6'=>'年級單檔','7'=>'年級多檔','0'=>'不用傳'];
                    $g_s_items = ['1'=>'普教題目','2'=>'特教題目'];
                    ?>
                    <tr>
                        <td width="120">
                            <label>所屬「大題」</label>
                        </td>
                        <td colspan="2">
                            {{ Form::select('topic_id',$topic_items,$question->topic_id,['required'=>'required']) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            子題號
                        </td>
                        <td colspan="2">
                            {{ Form::text('order_by',$question->order_by,['id'=>'order_by', 'placeholder' => '如 1.1','required'=>'required','maxlength'=>'4']) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>名稱</label>
                        </td>
                        <td colspan="2">
                            {{ Form::text('title',$question->title,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入名稱','required'=>'required']) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>題型</label>
                        </td>
                        <td colspan="2">
                            {{ Form::select('type',$type_items,$question->type,['required'=>'required']) }}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>類別</label>
                        </td>
                        <td>
                            {{ Form::select('g_s',$g_s_items,$question->g_s,['required'=>'required']) }}
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="return confirm('確定嗎？')">儲存修改</button>
                        </td>
                    </tr>
                    <input type="hidden" name="year" value="{{ $select_year }}">
                    {{ Form::close() }}
                </table>
            </table>
        </div>
    </div>
@endsection
