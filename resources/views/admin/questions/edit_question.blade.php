@extends('layouts.master_clean')

@section('title','修改 | ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{ Form::model($question,['route'=>['questions.update_question',$question->id],'method'=>'post']) }}
            @include('admin.questions.question_table')
            {{ Form::close() }}
        </div>
    </div>
@endsection
