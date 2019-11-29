@extends('layouts.master_clean')
@section('title','特教審查 | ')
@section('content')
    <h1>
        {{ auth()->user()->school }}：特教課程審查
    </h1>
<table class="table table-striped">
    <thead class="thead-light">
    <tr>
        @foreach($special_questions as $special_question)
            <?php
                $special_review = \App\SpecialReview::where('question_id',$special_question->id)
                    ->where('school_code',auth()->user()->code)
                    ->first();
            ?>
            <th style="vertical-align:text-top;">
                {{ $special_question->title }}
                @if($special_review)
                    123
                    <form action="{{ route('message') }}" method="post">
                        @csrf
                        <input type="hidden" name="for_user_id" value="{{ $special_review->user_id }}">
                        <button><i class="fas fa-comment-dots text-primary"></i></button>
                    </form>
                @endif
            </th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        <tr>
            @foreach($special_questions as $special_question)
                <?php
                $special_suggest = \App\SpecialSuggest::where('school_code',auth()->user()->code)
                    ->where('question_id',$special_question->id)
                    ->first();
                ?>
                <td>
                    @if($special_suggest)
                        結果：
                        @if($special_suggest->pass=="1")
                            <span class="text-success">符合！</span>
                        @endif
                        @if($special_suggest->pass=="0")
                            <span class="text-danger">不符合！</span>
                        @endif
                        <br>
                        建議：<br>
                        <span class="text-primary">
                            {!! nl2br($special_suggest->suggest) !!}
                        </span>
                    @else
                        <span class="text-warning">未審</span>
                    @endif
                </td>
            @endforeach
        </tr>
    </tbody>
</table>
@endsection
