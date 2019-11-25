@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title','課程計畫分享')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>
                <img src="{{ asset('images/thumbs-up.svg') }}" height="24">
                優良學校
            </h2>
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
                                {{ Form::open(['route'=>'excellent','method'=>'post']) }}
                                {{ Form::select('year',$years,$select_year,['onchange'=>'submit()']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <img src="{{ asset('images/1.png') }}" width="20%"><br>
                    @foreach($courses1 as $course)
                        <a href="{{ route('share_one',['select_year'=>$select_year,'school_code'=>$course->school_code]) }}" class="btn btn-success btn-sm" target="_blank" style="margin:5px">
                            <i class="fas fa-crown"></i>
                            {{ $schools[$course->school_code] }}
                        </a>
                    @endforeach
                    <hr>
                    <img src="{{ asset('images/2.png') }}" width="20%"><br>
                    @foreach($courses2 as $course)
                        <a href="{{ route('share_one',['select_year'=>$select_year,'school_code'=>$course->school_code]) }}" class="btn btn-success btn-sm" target="_blank" style="margin:5px">
                            <i class="fas fa-thumbs-up"></i>
                            {{ $schools[$course->school_code] }}
                        </a>
                    @endforeach
                    <hr>
                    <img src="{{ asset('images/3.png') }}" width="20%"><br>
                    @foreach($courses3 as $course)
                        <a href="{{ route('share_one',['select_year'=>$select_year,'school_code'=>$course->school_code]) }}" class="btn btn-success btn-sm" target="_blank" style="margin:5px">
                            {{ $schools[$course->school_code] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
