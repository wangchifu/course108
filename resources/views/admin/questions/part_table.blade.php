<table class="table">

    <tr>
        <td width="120">
            <label>序號</label>
        </td>
        <td colspan="2">
            {{ Form::select('order_by',$part_order_by,null,['required'=>'required']) }}
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
            <button class="btn btn-success btn-sm" onclick="return confirm('確定嗎？')"><i class="fas fa-save"></i> 儲存「部分」</button>
        </td>
    </tr>
    <input type="hidden" name="year" value="{{ $select_year }}">
</table>
