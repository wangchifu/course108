@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5>
                        <img src="{{ asset('images/news.svg') }}" height="24">
                        最新消息
                    </h5>
                </div>
                <div class="card-body">
                    @auth
                        @if(auth()->user()->admin==1)
                            <a href="{{ route('posts.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> 新增公告</a>
                        @endif
                    @endauth
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th width="120">
                                發佈日期
                            </th>
                            <th>
                                標題
                            </th>
                            <th width="120">
                                發佈單位
                            </th>
                            <th width="80">
                                瀏覽
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    {{ substr($post->created_at,0,10) }}
                                </td>
                                <td>
                                    <a href="{{ route('posts.show',$post->id) }}">{{ \Illuminate\Support\Str::limit($post->title,70) }}</a>
                                </td>
                                <td>
                                    {{ $post->user->name }}
                                </td>
                                <td>
                                    {{ $post->views }}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                        {{ $posts->links() }}
                </div>
            </div>
            <hr>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>
                        <img src="{{ asset('images/calendar.svg') }}" height="24">
                        審查時間表
                    </h5>
                </div>
                <div class="card-body">
                    @if($year)
                    <h5>{{ $year->year }} 學年度</h5><hr>
                    <strong>階段1：學校上傳：</strong><br>{{ $year->step1_date1 }}~{{$year->step1_date2}}<hr>
                    <strong>階段2：初審作業：</strong><br>{{ $year->step2_date1 }}~{{$year->step2_date2}}<hr>
                    <strong>階段2-1：依初審後再傳：</strong><br>{{ $year->step2_1_date1 }}~{{$year->step2_1_date2}}<hr>
                    <strong>階段2-2：初審後，三傳：</strong><br>{{ $year->step2_2_date1 }}~{{$year->step2_2_date2}}<hr>
                    <strong>階段3：複審作業：</strong><br>{{ $year->step3_date1 }}~{{$year->step3_date2}}<hr>
                    <strong>開放查詢：</strong><br>{{ $year->step4_date1 }}~{{$year->step4_date2}}
                    @endif
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
