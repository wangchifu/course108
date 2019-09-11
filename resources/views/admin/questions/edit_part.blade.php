@extends('layouts.master_clean')

@section('title','修改 | ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            {{ Form::model($part,['route'=>['questions.update_part',$part->id],'method'=>'post']) }}
            @include('admin.questions.part_table')
            {{ Form::close() }}
        </div>
    </div>
@endsection
