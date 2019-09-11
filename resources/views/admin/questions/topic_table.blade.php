<table class="table">

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
            {{ Form::text('order_by',null,['id'=>'order_by', 'placeholder' => '請輸入整數','required'=>'required','maxlength'=>'2']) }}
        </td>
    </tr>
    <tr>
        <td>
            <label>名稱</label>
        </td>
        <td>
            {{ Form::text('title',null,['id'=>'title','class' => 'form-control', 'placeholder' => '請輸入名稱','required'=>'required']) }}
        </td>
        <td>
            <button class="btn btn-success btn-sm" onclick="return confirm('確定嗎？')"><i class="fas fa-save"></i> 儲存「大題」</button>
        </td>
    </tr>
    <input type="hidden" name="year" value="{{ $select_year }}">
</table>
