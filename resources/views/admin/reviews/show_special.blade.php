@extends('layouts.master_clean',['bg_color'=>'bg-dark'])

@section('title','特教上傳情況')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>
                        {{ $select_year }} 特教課程上傳情況
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th nowrap>
                                校名
                            </th>
                            @foreach($special_questions as $special_question)
                                <th style="vertical-align: top">
                                    {{ $special_question->order_by }} {{ $special_question->title }}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>
                                    {{ $schools[$course->school_code] }}
                                </td>
                                @foreach($special_questions as $special_question)
                                    <?php
                                    $upload= \App\Upload::where('question_id',$special_question->id)
                                    ->where('code',$course->school_code)
                                    ->first();
                                    ?>
                                    <td>
                                        @if($upload)
                                            <span class="text-success">
                                                已上傳
                                            </span>
                                        @else
                                            <span>
                                                未傳
                                            </span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
