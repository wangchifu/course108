@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title',' 普教審查管理 | ')

@section('content')
    <?php
        for($i=1;$i<8;$i++){
            $active[$i] = null;
        }
        $active[5] = "active";
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
                    <a href="javascript:open_window2('{{ route('reviews.first_by_user',['select_year'=>$select_year]) }}','新視窗')" class="btn btn-info btn-sm"><i class="fas fa-user"></i> 依初委選學校</a>
                    <a href="javascript:open_window2('{{ route('reviews.second_by_user',['select_year'=>$select_year]) }}','新視窗')" class="btn btn-info btn-sm"><i class="far fa-user"></i> 依複委選學校</a>
                    <a href="{{ route('reviews.open',$select_year) }}" class="btn btn-success btn-sm" onclick="return confirm('確定全部公開？')"><i class="fas fa-share"></i> 全部公開</a>
                    <a href="{{ route('reviews.close',$select_year) }}" class="btn btn-danger btn-sm" onclick="return confirm('確定全部關閉？')"><i class="fas fa-times-circle"></i> 全部關閉</a>
                    <table border="1" width="100%" class="table-striped">
                        <thead>
                        <tr>
                            <th nowrap style="background-color: #c4e1ff">
                                校名
                            </th>
                            <th nowrap>
                                初審<br>委員
                            </th>
                            <th nowrap style="background-color:#fff8d7">
                                初審<br>狀況<br><a href="{{ route('reviews.not_send',['result'=>'1','select_year'=>$select_year]) }}" class="badge badge-danger" target="_blank">未送名單</a>
                            </th>
                            <th style="background-color:#fff8d7">
                                再傳<br>狀況<br><a href="{{ route('reviews.not_send',['result'=>'2','select_year'=>$select_year]) }}" class="badge badge-danger" target="_blank">未送名單</a>
                            </th>
                            <th style="background-color:#fff8d7">
                                三傳<br>狀況<br><a href="{{ route('reviews.not_send',['result'=>'3','select_year'=>$select_year]) }}" class="badge badge-danger" target="_blank">未送名單</a>
                            </th>
                            <th nowrap>
                                複審<br>委員
                            </th>
                            <th nowrap style="background-color: #ffd2d2">
                                複審<br>結果
                            </th>
                            <th nowrap style="background-color: #ceffce">
                                公開
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td nowrap>
                                    {{ $schools[$course->school_code] }} <small>({{ $course->school_code }})</small>
                                </td>
                                <td>
                                    <a href="javascript:open_window('{{ route('reviews.first_user',['select_year'=>$select_year,'school_code'=>$course->school_code]) }}','新視窗')"><i class="fas fa-list-ul"></i></a>
                                    {{ $first_name[$course->school_code] }}
                                    @if($first_name[$course->school_code])
                                    <a href="{{ route('reviews.first_review_delete',$course->id) }}" onclick="return confirm('確定刪除嗎？')">
                                        <i class="fas fa-times-circle text-danger"></i>
                                    </a>
                                    @endif
                                </td>
                                <td>
                                    @if($course->first_result1==null)
                                        <span class="text-dark">未送審</span>
                                    @endif
                                    @if($course->first_result1=='late')
                                        <span class="text-warning">未交</span>
                                    @endif
                                    @if($course->first_result1=="submit")
                                        <span class="text-primary">已送審</span>
                                        <a href="{{ route('reviews.back_null',['course'=>$course->id,'page'=>$page,'action'=>'1']) }}" onclick="return confirm('確定設為未送審？')">
                                            <i class="fas fa-times-circle text-danger"></i>
                                        </a>
                                    @endif
                                    @if($course->first_result1=="ok")
                                        <span class="text-primary">已通過</span>
                                    @endif
                                    @if($course->first_result1=="back")
                                        <span class="text-danger">被退回</span>
                                    @endif
                                    @if($course->first_result1=="excellent")
                                        <span class="text-success">進入複審</span>
                                    @endif
                                </td>
                                <td>
                                    @if($course->first_result2==null and $course->first_result1=="back")
                                        <span class="text-dark">未送審</span>
                                    @endif
                                    @if($course->first_result2=="submit")
                                        <span class="text-primary">已送審</span>
                                        <a href="{{ route('reviews.back_null',['course'=>$course->id,'page'=>$page,'action'=>'2']) }}" onclick="return confirm('確定設為未送審？')">
                                            <i class="fas fa-times-circle text-danger"></i>
                                        </a>
                                    @endif
                                    @if($course->first_result2=="ok")
                                        <span class="text-primary">已通過</span>
                                    @endif
                                    @if($course->first_result2=="back")
                                        <span class="text-danger">被退回</span>
                                    @endif
                                    @if($course->first_result2=="excellent")
                                        <span class="text-success">進入複審</span>
                                    @endif
                                </td>
                                <td>
                                    @if($course->first_result3==null and $course->first_result2=="back")
                                        <span class="text-dark">未送審</span>
                                    @endif
                                    @if($course->first_result3=="submit")
                                        <span class="text-primary">已送審</span>
                                        <a href="{{ route('reviews.back_null',['course'=>$course->id,'page'=>$page,'action'=>'3']) }}" onclick="return confirm('確定設為未送審？')">
                                            <i class="fas fa-times-circle text-danger"></i>
                                        </a>
                                    @endif
                                    @if($course->first_result3=="ok")
                                        <span class="text-primary">已通過</span>
                                    @endif
                                    @if($course->first_result3=="back")
                                        <span class="text-danger">被退回</span>
                                    @endif
                                    @if($course->first_result3=="excellent")
                                        <span class="text-success">進入複審</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="javascript:open_window('{{ route('reviews.second_user',['select_year'=>$select_year,'school_code'=>$course->school_code]) }}','新視窗')"><i class="fas fa-list-ul"></i></a>
                                    {{ $second_name[$course->school_code] }}
                                    @if($second_name[$course->school_code])
                                        <a href="{{ route('reviews.second_review_delete',$course->id) }}" onclick="return confirm('確定刪除嗎？')">
                                            <i class="fas fa-times-circle text-danger"></i>
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    @if($course->second_result=="ok")
                                        <span class="text-primary">已通過</span>
                                    @endif
                                    @if($course->second_result=="excellent1")
                                        <span class="text-success">1.特優</span>
                                    @endif
                                    @if($course->second_result=="excellent2")
                                        <span class="text-success">2.優等</span>
                                    @endif
                                    @if($course->second_result=="excellent3")
                                        <span class="text-success">3.甲等</span>
                                    @endif
                                </td>
                                <td>
                                    @if($open[$course->school_code])
                                        是 <small><a href="{{ route('reviews.select_close',['select_year'=>$select_year,'school_code'=>$course->school_code]) }}" onclick="return confirm('確定關閉？')"><i class="fas fa-times-circle text-danger"></i></a></small>
                                    @else
                                        否 <small><a href="{{ route('reviews.select_open',['select_year'=>$select_year,'school_code'=>$course->school_code]) }}" onclick="return confirm('確定開放？')"><i class="fas fa-plus-circle text-success"></i></a></small>
                                    @endif
                                </td>
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
