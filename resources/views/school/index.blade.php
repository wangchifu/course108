@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title','學校專區 | ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
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

                            </td>
                        </tr>
                    </table>
                    {{ Form::open(['route'=>'schools.index','method'=>'get']) }}
                    {{ Form::select('year',$year_items,$select_year,['onchange'=>'submit()']) }}
                    {{ Form::close() }}
                </div>
                <div class="card-body">
                    <a href="{{ route('schools.show_log',$select_year) }}" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-eye"></i> 檢視上傳歷程</a>
                    @if(check_date($select_year,'1') or check_date($select_year,'2_1') or check_date($select_year,'2_2'))
                        @if(($course->first_result1==null or $course->first_result1=="back" or $course->first_result1=="late") and ($course->first_result2 ==null or $course->first_result2 =="back") and ($course->first_result3 ==null))
                            <a href="{{ route('schools.edit',$select_year) }}" class="btn btn-success btn-sm"><i class="fas fa-upload"></i> 上傳普教課程</a>
                        @endif
                        @if($course->special_result==null or $course->special_result=="back")
                            <a href="{{ route('schools.edit2',$select_year) }}" class="btn btn-outline-success btn-sm"><i class="fas fa-upload"></i> 上傳特教課程</a>
                        @endif
                    @endif
                    <br><br>
                    @if($course->second_result=="excellent1")
                        <img src="{{ asset('images/1.png') }}" width="100%">
                    @endif
                    @if($course->second_result=="excellent2")
                        <img src="{{ asset('images/2.png') }}" width="100%">
                    @endif
                    @if($course->second_result=="excellent3")
                        <img src="{{ asset('images/3.png') }}" width="100%">
                    @endif
                    <table class="table table-striped">
                        <tr>
                            <th colspan="5">
                                課程首次上傳
                                <a href="{{ route('schools.show_all',$course->year) }}" class="badge badge-danger" target="_blank">顯示全部結果</a>
                                <br>
                                <small>{{ $year->step1_date1 }}~{{$year->step1_date2}}</small>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                普教初審<br>
                                @if($course->first_user_id)
                                    <form action="{{ route('message') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="for_user_id" value="{{ $course->first_user_id }}">
                                        <button><i class="fas fa-comment-dots text-primary"></i></button>
                                    </form>
                                @endif
                                <small>{{ $year->step2_date1 }}~{{$year->step2_date2}}</small>
                            </th>
                            <th>
                                普教初審-再傳<br>
                                <small>{{ $year->step2_1_date1 }}~{{$year->step2_1_date2}}</small>
                            </th>
                            <th>
                                普教初審-三傳<br>
                                <small>{{ $year->step2_2_date1 }}~{{$year->step2_2_date2}}</small>
                            </th>
                            <th>
                                特教審查
                            </th>
                            <th>
                                普教複審<br>
                                @if($course->second_user_id)
                                    <form action="{{ route('message') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="for_user_id" value="{{ $course->second_user_id }}">
                                        <button><i class="fas fa-comment-dots text-primary"></i></button>
                                    </form>
                                @endif
                                <small>{{ $year->step3_date1 }}~{{$year->step3_date2}}</small><br>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                @if($course->first_result1==null)
                                    <span class="text-danger">未送審</span>
                                @endif
                                @if($course->first_result1=='late')
                                    <span class="text-warning">未交</span>
                                @endif
                                @if($course->first_result1=="submit")
                                    <span>已送審</span>
                                @endif
                                @if($course->first_result1=="ok")
                                    <span class="text-info">已通過</span>
                                @endif
                                @if($course->first_result1=="back")
                                    <span class="text-danger">被退回</span>
                                @endif
                                @if($course->first_result1=="excellent")
                                    <span class="text-success">進入複審</span>
                                @endif
                            </td>
                            <td>
                                @if($course->first_result2==null and $course->first_result1 == "back")
                                    <span class="text-danger">未送審</span>
                                @endif
                                @if($course->first_result2=="submit")
                                    <span>已送審</span>
                                @endif
                                @if($course->first_result2=="ok")
                                    <span class="text-info">已通過</span>
                                @endif
                                @if($course->first_result2=="back")
                                    <span class="text-danger">被退回</span>
                                @endif
                                @if($course->first_result2=="excellent")
                                    <span class="text-success">進入複審</span>
                                @endif
                            </td>
                            <td>
                                @if($course->first_result3==null and $course->first_result2 == "back")
                                    <span class="text-danger">未送審</span>
                                @endif
                                @if($course->first_result3=="submit")
                                    <span>已送審</span>
                                @endif
                                @if($course->first_result3=="ok")
                                    <span class="text-info">已通過</span>
                                @endif
                                @if($course->first_result3=="back")
                                    <span class="text-danger">被退回</span>
                                @endif
                                @if($course->first_result3=="excellent")
                                    <span class="text-success">進入複審</span>
                                @endif
                            </td>
                            <td>
                                @if($course->special_result==null)
                                    <span class="text-warning">未送審</span>
                                @endif
                                @if($course->special_result=="submit")
                                    <span class="text-primary">已送審</span>
                                    <a href="{{ route('schools.show_special',$course->year) }}" class="badge badge-danger" target="_blank">顯示特教結果</a>
                                @endif
                            </td>
                            <td>
                                @if($course->second_result=="ok")
                                    <span class="text-primary">已通過</span>
                                @endif
                                @if($course->second_result=="excellent1")
                                    <i class="fas fa-crown text-warning"></i> <span class="text-success">1.特優</span>
                                @endif
                                @if($course->second_result=="excellent2")
                                    <i class="fas fa-thumbs-up text-primary"></i> <span class="text-success">2.優等</span>
                                @endif
                                @if($course->second_result=="excellent3")
                                    <span class="text-success">3.甲等</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    @include('layouts.base_course')
                </div>
            </div>
        </div>
    </div>
@endsection
