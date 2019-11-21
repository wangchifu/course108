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
                                {{ Form::open(['route'=>'questions.index','method'=>'post']) }}
                                {{ Form::select('year',$year_items,$select_year,['onchange'=>'submit()']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <a href="{{ route('schools.show_log',$select_year) }}" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-eye"></i> 檢視上傳歷程</a>
                    @if(check_in_date($select_year))
                        @if(($course->first_result1==null or $course->first_result1=="back") and ($course->first_result2 ==null or $course->first_result2 =="back"))
                            <a href="{{ route('schools.edit',$select_year) }}" class="btn btn-success btn-sm"><i class="fas fa-upload"></i> 上傳普教課程</a>
                        @endif
                        @if($course->special_result==null or $course->special_result=="back")
                            <a href="{{ route('schools.edit2',$select_year) }}" class="btn btn-outline-success btn-sm"><i class="fas fa-upload"></i> 上傳特教課程</a>
                        @endif
                    @endif
                    <br><br>
                    <table class="table table-striped">
                        <tr>
                            <th colspan="5">
                                課程首次上傳<br>
                                <small>{{ $year->step1_date1 }}~{{$year->step1_date2}}</small>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                普教初審<br>
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
                                <small>{{ $year->step3_date1 }}~{{$year->step3_date2}}</small>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                @if($course->first_result1==null)
                                    <span class="text-danger">未送審</span>
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
                                @endif

                            </td>
                            <td>
                                5
                            </td>
                        </tr>
                    </table>
                    @include('layouts.base_course')
                </div>
            </div>
        </div>
    </div>
@endsection
