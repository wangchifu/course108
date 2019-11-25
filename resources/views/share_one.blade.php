@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title','課程計畫分享')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>
                        @if($course->second_result=="excellent1")
                            <h3>
                                <img src="{{ asset('images/gold-medal.svg') }}" width="50"><span class="text-danger">優秀課程計畫得獎學校！(特優)</span><br>
                            </h3>
                        @endif
                        @if($course->second_result=="excellent2")
                            <h3>
                                <img src="{{ asset('images/medal.svg') }}" width="50"><span class="text-danger">優秀課程計畫得獎學校！(優等)</span><br>
                            </h3>
                        @endif
                        @if($course->second_result=="excellent3")
                            <h3>
                                <img src="{{ asset('images/bronze-medal.svg') }}" width="50"><span class="text-danger">優秀課程計畫得獎學校！(甲等)</span><br>
                            </h3>
                        @endif
                    </h5>
                </div>
                <div class="card-body">
                    @include('layouts.base_course')
                </div>
            </div>
        </div>
    </div>
@endsection
