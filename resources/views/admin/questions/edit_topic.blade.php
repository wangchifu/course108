@extends('layouts.master_clean')

@section('title','修改 | ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{ Form::model($topic,['route'=>['questions.update_topic',$topic->id],'method'=>'post']) }}
            @include('admin.questions.topic_table')
            {{ Form::close() }}
        </div>
    </div>
@endsection
