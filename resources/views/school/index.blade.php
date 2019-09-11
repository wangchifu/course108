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
                    <a href="" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> 檢視上傳歷程</a>
                    <a href="{{ route('schools.edit',$select_year) }}" class="btn btn-success btn-sm"><i class="fas fa-upload"></i> 上傳檔案</a>
                    <br><br>
                    <table class="table table-striped">
                        <tr>
                            <th colspan="3">
                                普教初審<br>
                                <small>{{ $year->step1_date1 }}~{{$year->step1_date2}}</small>
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
                            <th>
                                初審<br>
                                <small>{{ $year->step2_date1 }}~{{$year->step2_date2}}</small>
                            </th>
                            <th>
                                初審-再傳<br>
                                <small>{{ $year->step2_1_date1 }}~{{$year->step2_1_date2}}</small>
                            </th>
                            <th>
                                初審-三傳<br>
                                <small>{{ $year->step2_2_date1 }}~{{$year->step2_2_date2}}</small>
                            </th>
                            <td>
                                123
                            </td>
                            <td rowspan="2">

                            </td>
                        </tr>
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                2
                            </td>
                            <td>
                                3
                            </td>
                        </tr>
                    </table>
                    <h1>{{ auth()->user()->school }} {{ $select_year }}學年度課程計畫</h1>
                    @include('school.questions')
                </div>
            </div>
        </div>
    </div>
@endsection
