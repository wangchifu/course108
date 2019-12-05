@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title',' 普教審查管理 | ')

@section('content')
    <?php
        for($i=1;$i<8;$i++){
            $active[$i] = null;
        }
        $active[6] = "active";
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
                    @foreach($special_questions as $special_question)
                        <a href="javascript:open_window2('{{ route('reviews.special_by_user',['select_year'=>$select_year,'question'=>$special_question->id]) }}','新視窗')" class="btn btn-info btn-sm"><i class="fas fa-user"></i> 審「{{ $special_question->order_by }}」委員選學校</a>
                    @endforeach
                    <table border="1" width="100%" class="table-striped">
                        <thead>
                        <tr>
                            <th nowrap style="background-color: #c4e1ff">
                                校名
                                <br><a href="{{ route('reviews.show_special',$select_year) }}" class="badge badge-danger" target="_blank">上傳情況</a>
                            </th>
                            @foreach($special_questions as $special_question)
                                <th>
                                    {{ $special_question->order_by }}：
                                    {{ $special_question->title }}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td nowrap>
                                    {{ $schools[$course->school_code] }} <small>({{ $course->school_code }})</small>
                                </td>
                                @foreach($special_questions as $special_question)
                                    <td>
                                        <a href="javascript:open_window('{{ route('reviews.special_user',['question'=>$special_question->id,'select_year'=>$select_year,'school_code'=>$course->school_code]) }}','新視窗')"><i class="fas fa-list-ul"></i></a>
                                        @if(isset($s_r[$course->school_code][$special_question->id]))
                                        {{ $s_r[$course->school_code][$special_question->id] }}
                                            <a href="{{ route('reviews.special_review_delete',$special_review_id[$course->school_code][$special_question->id]) }}" onclick="return confirm('確定刪除嗎？')">
                                                <i class="fas fa-times-circle text-danger"></i>
                                            </a>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        <!--
        function open_window(url,name)
        {
            window.open(url,name,'statusbar=no,scrollbars=yes,status=yes,resizable=yes,width=900,height=180');
        }
        function open_window2(url,name)
        {
            window.open(url,name,'statusbar=no,scrollbars=yes,status=yes,resizable=yes,width=600,height=800');
        }
        // -->
    </script>
@endsection
