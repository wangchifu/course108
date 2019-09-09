@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title', '公告內容 | ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">公告首頁</a></li>
                    <li class="breadcrumb-item active" aria-current="page">公告內容</li>
                </ol>
            </nav>
            <h2>{{ $post->title }}</h2>
            <small>發布單位： {{ $post->user->name }} ｜ 發布日期： {{ substr($post->created_at,0,10) }} ｜ 點閱： {{ $post->views }}</small>
            @auth
                @if(auth()->user()->admin =="1")
                    <a href="{{ route('posts.edit',$post->id) }}"><span class="badge badge-primary">編輯</span></a>
                    <a href="#" onclick="if(confirm('您確定要刪除嗎?')) getElementById('delete').submit();else return false"><span class="badge badge-danger">刪除</span></a>
                    {{ Form::open(['route' => ['posts.destroy',$post->id], 'method' => 'DELETE','id'=>'delete']) }}
                    {{ Form::close() }}
                @endif
            @endauth
            <?php
            $content = nl2br($post->content);
            ?>
            <div style="border:1px #ccc solid;border-radius:2px;background-color:#eee;padding:10px;">
                <p style="font-size: 1.2rem;">
                    {!! $content !!}
                </p>
            </div>
            @if(!empty($files))
                <div class="card my-4">
                    <h6 class="card-header">附件下載</h6>
                    <div class="card-body">
                        @foreach($files as $k=>$v)
                            <?php
                            $file = "posts/".$post->id."/".$v;
                            $file = str_replace('/','&',$file);
                            ?>
                            <a href="{{ url('file/'.$file) }}" class="btn btn-primary btn-sm" style="margin:3px"><i class="fas fa-download"></i> {{ $v }}</a>
                        @endforeach
                    </div>
                </div>
            @endif
            <hr>
            <a href="{{ route('index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
        </div>
    </div>
@endsection
