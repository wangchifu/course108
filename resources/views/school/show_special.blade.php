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
            <th>
                {{ $special_question->title }}
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
                        @if($special_suggest->pass=="1")
                            <span class="text-success">符合！</span>
                        @endif
                        @if($special_suggest->pass=="0")
                            <span class="text-danger">不符合！</span>
                        @endif
                        <br>
                        {{ $special_suggest->suggest }}
                    @else
                        <span class="text-warning">未審</span>
                    @endif
                </td>
            @endforeach
        </tr>
    </tbody>
</table>
@endsection
