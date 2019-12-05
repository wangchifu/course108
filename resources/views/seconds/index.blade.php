@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title','複審作業')

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
                                {{ Form::open(['route'=>'seconds.index','method'=>'post']) }}
                                {{ Form::select('year',$years,$select_year,['onchange'=>'submit()']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th nowrap>
                                代碼
                            </th>
                            <th nowrap>
                                校名
                            </th>
                            <th nowrap>
                                複審作業
                            </th>
                            <th>
                                結果
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>
                                    {{ $course->school_code }}
                                </td>
                                <td>
                                    {{ $schools[$course->school_code] }}
                                </td>
                                <td>
                                    <a href="{{ route('seconds.create',['course'=>$course->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>進行審核</a>
                                </td>
                                <td>
                                    @if($course->second_result=="ok")
                                        <span class="text-info">通過</span>
                                    @elseif($course->second_result=="excellent1")
                                        <span class="text-success">1.特優</span>
                                    @elseif($course->second_result=="excellent2")
                                        <span class="text-success">2.優等</span>
                                    @elseif($course->second_result=="excellent3")
                                        <span class="text-success">3.甲等</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
