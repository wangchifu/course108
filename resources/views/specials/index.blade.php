@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title','特教審核')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <table>
                        <tr>
                            <td>
                                <img src="{{ asset('images/check.svg') }}" height="24">
                            </td>
                            <td>
                                選擇年度：
                            </td>
                            <td>
                                {{ Form::open(['route'=>'specials.index','method'=>'post']) }}
                                {{ Form::select('year',$years,$select_year,['onchange'=>'submit()']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th nowrap>
                                校名
                            </th>
                            @foreach($special_questions as $special_question)
                                <th>
                                    {{ $special_question->title }}
                                </th>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($special_review_data as $k=>$v)
                            <tr>
                                <td>
                                    {{ $schools[$k] }}
                                </td>
                                @foreach($special_questions as $special_question)
                                    <td>
                                        <?php
                                        ?>
                                        @if(isset($v[$special_question->id]['user']) and isset($v[$special_question->id]['id']))
                                            @if($v[$special_question->id]['user'] == auth()->user()->id)
                                                <a href="{{ route('specials.create',['special_review'=>$v[$special_question->id]['id']]) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>進行審核</a>
                                            @endif
                                        @endif
                                        <?php
                                            $special_suggest = \App\SpecialSuggest::where('question_id',$special_question->id)
                                            ->where('school_code',$k)
                                            ->first();
                                        ?>
                                        @if($special_suggest)
                                            @if($special_suggest->pass =="1")
                                                <span class="text-success">符合</span>
                                            @endif
                                            @if($special_suggest->pass =="0")
                                                <span class="text-danger">不符合</span>
                                            @endif
                                        @else
                                                <span class="text-warning">未審</span>
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
