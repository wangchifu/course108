@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('page-title', '錯誤')

@section('content')
    <div>
        <h1 class="display-4 text-dark">Hello, 你弄錯了!</h1>
        <p class="lead">這是錯誤頁面，你有東西搞錯了，想想你做了什麼事情不對，然後返回再試一次吧！</p>
        <hr class="my-4">
        <h2 class="text-danger">錯誤說明：<strong>{{ $words }}</strong></h2>
        <button onclick="history.back();" class="btn btn-secondary"><i class="fas fa-backward"></i> 返回</button>
    </div>
@endsection
