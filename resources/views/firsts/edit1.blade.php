@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title','初審作業')

@foreach($questions as $question)
    @if($question->g_s == 1 and $question->type != "0")
        @section('input'.$question->id)
            <?php
                if($f_s1[$question->id]['pass']==1){
                    $check1 = "checked";
                    $check2 = null;
                }elseif($f_s1[$question->id]['pass']==0){
                    $check1 = null;
                    $check2 = "checked";
                }
            ?>
            <td style="vertical-align:top;background-color: #FFEE99">
                <input type="hidden" name="questions[]" value="{{ $question->id }}">
                <input type="radio" name="check_{{ $question->id }}" id="check1_{{ $question->id }}" {{ $check1 }} value="1" checked> <label for="check1_{{ $question->id }}">符合</label>　
                <input type="radio" name="check_{{ $question->id }}" id="check2_{{ $question->id }}" {{ $check2 }} value="0"> <label for="check2_{{ $question->id }}">不符合</label>
                <br>
                <textarea name="suggest_{{ $question->id }}" placeholder="請填建議">{{ $f_s1[$question->id]['suggest'] }}</textarea>
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
                    <li class="breadcrumb-item active" aria-current="page">審查 {{ $school_name }} 一傳</li>
                </ol>
            </nav>
            <form action="{{ route('firsts.update1') }}" method="post">
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
                        <?php
                            if($course->first_result1=="ok"){
                                $select1 = "selected";
                                $select2 = null;
                                $select3 = null;
                            }elseif($course->first_result1=="back"){
                                $select1 = null;
                                $select2 = "selected";
                                $select3 = null;
                            }elseif($course->first_result1=="excellent"){
                                $select1 = null;
                                $select2 = null;
                                $select3 = "selected";
                            }
                        ?>
                        <td colspan="2">
                            <select name="first_result1" class="form-control" required>
                                <option value="" disabled>
                                    -----請選擇初審結果-----
                                </option>
                                <option value="ok" {{ $select1 }}>
                                    符合！無需修改！
                                </option>
                                <option value="back" {{ $select2 }}>
                                    退回！修改後再審！
                                </option>
                                <option value="excellent" {{ $select3 }}>
                                    優秀！進入複審！
                                </option>
                            </select>
                        </td>
                        <td colspan="3">
                            <textarea name="first_reason1" class="form-control">{{ $course->first_reason1 }}</textarea>
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
