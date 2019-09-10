@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title','題目 | ')

@section('content')
    <?php
    for($i=1;$i<8;$i++){
        $active[$i] = null;
    }
    $active[3] = "active";
    ?>
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('admin.side',['active'=>$active])
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <table>
                        <tr>
                            <td>
                                <img src="{{ asset('images/check.svg') }}" height="24">
                            </td>
                            <td>
                                選擇年度：
                            </td>
                            <td>
                                {{ Form::open(['route'=>'questions.index','method'=>'post']) }}
                                {{ Form::select('year',$year_items,$select_year,['onchange'=>'submit()']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <h5>1.新增部分</h5>
                    <table class="table">
                        {{ Form::open(['route'=>'questions.store_part','method'=>'post']) }}
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
                                <button class="btn btn-success btn-sm" onclick="return confirm('確定嗎？')">新增「部分」</button>
                            </td>
                        </tr>
                            <input type="hidden" name="year" value="{{ $select_year }}">
                        {{ Form::close() }}
                    </table>
                    <h5>2.新增大題</h5>
                    <table class="table">
                        {{ Form::open(['route'=>'questions.store_topic','method'=>'post']) }}
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
                                <button class="btn btn-success btn-sm" onclick="return confirm('確定嗎？')">新增「大題」</button>
                            </td>
                        </tr>
                        <input type="hidden" name="year" value="{{ $select_year }}">
                        {{ Form::close() }}
                    </table>
                    <h5>3.新增子題</h5>
                    <table class="table">
                        {{ Form::open(['route'=>'questions.store_question','method'=>'post']) }}
                        <?php
                            $type_items = ['1'=>'單檔','2'=>'多檔','3'=>'年級科目節數','4'=>'年級科目單檔','5'=>'年級科目版本','6'=>'年級單檔','7'=>'年級多檔','0'=>'不用傳'];
                            $g_s_items = ['1'=>'普教題目','2'=>'特教題目'];
                        ?>
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
                                {{ Form::text('order_by',null,['id'=>'order_by', 'placeholder' => '如 1.1','required'=>'required','maxlength'=>'4']) }}
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
                                <label>類別</label>
                            </td>
                            <td>
                                {{ Form::select('g_s',$g_s_items,null,['required'=>'required']) }}
                            </td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="return confirm('確定嗎？')">新增「子題」</button>
                            </td>
                        </tr>
                        <input type="hidden" name="year" value="{{ $select_year }}">
                        {{ Form::close() }}
                    </table>
                </div>
            </div>
            <hr>
            <div class="card">
                <div class="card-header">
                    <h2>題目列表</h2>
                </div>
                <div class="card-body">
                    @foreach($parts as $part)
                        <div class="row title-div">
                            <div class="col-12">
                                <h3>
                                    {{ $part_order_by[$part->order_by] }}、{{ $part->title }} <a href="javascript:open_upload('{{ route('questions.edit_part',['part'=>$part->id,'select_year'=>$select_year]) }}','新視窗')"><i class="text-primary fas fa-edit"></i></a> <a href="{{ route('questions.delete_part',$part->id) }}" onclick="return confirm('確定刪除？底下所屬一併刪除喔！！')"><i class="text-danger fas fa-trash"></i></a>
                                </h3>
                            </div>
                        </div>
                        <div class="row custom-div">
                            @foreach($part->topics as $topic)
                            <div class="col-2">
                                <div class="section-div">
                                    {{ $topic->order_by }}.{{ $topic->title }} <a href="javascript:open_upload('{{ route('questions.edit_topic',['topic'=>$topic->id,'select_year'=>$select_year]) }}','新視窗')"><i class="text-primary fas fa-edit"></i></a> <a href="{{ route('questions.delete_topic',$topic->id) }}" onclick="return confirm('確定刪除？底下所屬一併刪除喔！！')"><i class="text-danger fas fa-trash"></i></a>
                                </div>
                            </div>
                            <div class="col-10">
                            @foreach($topic->questions as $question)
                                <div class="centent-div">
                                    {{ $question->order_by }} {{ $question->title }} <a href="javascript:open_upload('{{ route('questions.edit_question',['question'=>$question->id,'select_year'=>$select_year]) }}','新視窗')"><i class="text-primary fas fa-edit"></i></a> <a href="{{ route('questions.delete_question',$question->id) }}" onclick="return confirm('確定刪除？')"><i class="text-danger fas fa-trash"></i></a><br>
                                    ({{ $type_items[$question->type] }}
                                    @if($question->g_s=="1")
                                        <span class="text-primary">{{ $g_s_items[$question->g_s] }})</span>
                                    @elseif($question->g_s=="2")
                                        <span class="text-danger">{{ $g_s_items[$question->g_s] }})</span>
                                    @endif
                                </div>
                            @endforeach
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        function open_upload(url,name)
        {
            window.open(url,name,'statusbar=no,scrollbars=yes,status=yes,resizable=yes,width=800,height=400');
        }
    </script>
@endsection
