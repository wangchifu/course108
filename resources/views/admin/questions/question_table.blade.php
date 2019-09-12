<table class="table">
    <tr>
        <td width="120">
            <label>所屬「大題」</label>
        </td>
        <td colspan="2">
            {{ Form::select('topic_id',$topic_items,null,['required'=>'required']) }}
        </td>
    </tr>
    <tr>
        <td>
            子題號
        </td>
        <td colspan="2">
            {{ Form::text('order_by',null,['id'=>'order_by', 'placeholder' => '如 1.1','required'=>'required','maxlength'=>'5']) }}
        </td>
    </tr>
    <tr>
        <td>
            <label>名稱</label>
        </td>
        <td colspan="2">
            {{ Form::text('title',null,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入名稱','required'=>'required']) }}
        </td>
    </tr>
    <tr>
        <td>
            <label>題型</label>
        </td>
        <td colspan="2">
            {{ Form::select('type',$type_items,null,['required'=>'required']) }}
        </td>
    </tr>
    <tr>
        <td>
            <label>必填？</label>
        </td>
        <td colspan="2">
            {{ Form::checkbox('need','1',null,['id'=>'need']) }} <label for="need" class="text-danger">必填</label>
        </td>
    </tr>
    <tr>
        <td>
            <label>類別</label>
        </td>
        <td>
            {{ Form::select('g_s',$g_s_items,null,['required'=>'required']) }}
        </td>
        <td>
            <button class="btn btn-success btn-sm" onclick="return confirm('確定嗎？')"><i class="fas fa-save"></i> 儲存「子題」</button>
        </td>
    </tr>
    <input type="hidden" name="year" value="{{ $select_year }}">
</table>
