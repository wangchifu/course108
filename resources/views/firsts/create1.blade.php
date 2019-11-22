@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title','初審作業')

@foreach($questions as $question)
    @if($question->g_s == 1 and $question->type != "0")
        @section('input'.$question->id)
            <td style="vertical-align:top;background-color: #FFEE99">
                <input type="hidden" name="questions[]" value="{{ $question->id }}">
                <input type="radio" name="check_{{ $question->id }}" id="check1_{{ $question->id }}" checked value="1" checked> <label for="check1_{{ $question->id }}">符合</label>　
                <input type="radio" name="check_{{ $question->id }}" id="check2_{{ $question->id }}" value="0"> <label for="check2_{{ $question->id }}">不符合</label>
                <br>
                <textarea name="suggest_{{ $question->id }}"></textarea>
            </td>
        @endsection
    @endif
@endforeach

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('firsts.index') }}">初審作業</a></li>
                    <li class="breadcrumb-item active" aria-current="page">審查 {{ $school_name }}</li>
                </ol>
            </nav>
            <form action="{{ route('firsts.store1') }}" method="post">
            @csrf
                @include('layouts.base_course1')
                <table class="table">
                    <tr class="bg-info">
                        <th colspan="2">
                            初審結果
                        </th>
                        <th colspan="3">
                            審查意見
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <select name="first_result1" class="form-control" required>
                                <option value="" disabled selected>
                                    -----請選擇初審結果-----
                                </option>
                                <option value="ok" selected>
                                    符合！無需修改！
                                </option>
                                <option value="back" >
                                    退回！修改後再審！
                                </option>
                                <option value="excellent" >
                                    優秀！進入複審！
                                </option>
                            </select>
                        </td>
                        <td colspan="3">
                            <textarea name="first_reason1" class="form-control"></textarea>
                        </td>
                    </tr>
                </table>
                <br>
                <a href="#" class="btn btn-secondary btn-sm" onclick="history.back();"><i class="fas fa-backward"></i> 返回</a>
                <input type="hidden" name="school_code" value="{{ $school_code }}">
                <input type="hidden" name="course_id" value="{{ $course->id }}">
                <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('確定儲存？')">
                    <i class="fas fa-save"></i> 儲存設定
                </button>
            </form>
        </div>
    </div>
@endsection
