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
                            <td>----------
                            </td>
                            <td>
                                {{ Form::open(['route'=>'questions.copy','method'=>'post']) }}
                                或是從
                                {{ Form::select('b_year',$year_items,$select_year) }}
                                複製到
                                {{ Form::select('l_year',$year_items,$select_year) }}
                                <button class="btn btn-success btn-sm" onclick="return confirm('會刪掉後者，把前者複製到後者喔！')"><i class="fas fa-copy"></i> 複製</button>
                                {{ Form::close() }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <h5>1.新增部分</h5>
                    {{ Form::open(['route'=>'questions.store_part','method'=>'post']) }}
                    @include('admin.questions.part_table')
                    {{ Form::close() }}
                    <h5>2.新增大題</h5>
                    {{ Form::open(['route'=>'questions.store_topic','method'=>'post']) }}
                    @include('admin.questions.topic_table')
                    {{ Form::close() }}
                    <h5>3.新增子題</h5>
                    {{ Form::open(['route'=>'questions.store_question','method'=>'post']) }}
                    @include('admin.questions.question_table')
                    {{ Form::close() }}
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
                                        (
                                        @if($question->need=="1")
                                            <span class="text-danger">必填</span>
                                        @else
                                            <span class="text-info">非必填</span>
                                        @endif
                                        {{ $type_items[$question->type] }}
                                        @if($question->g_s=="1")
                                            <span class="text-primary">{{ $g_s_items[$question->g_s] }}</span>
                                        @elseif($question->g_s=="2")
                                            <span class="text-danger">{{ $g_s_items[$question->g_s] }}</span>
                                        @endif
                                        )
                                    </div>
                                    @if($question->type!="0")
                                        <br>
                                    @endif
                                @endforeach
                            </div>
                            <br>
                            @endforeach
                        </div>
                        <br>
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
