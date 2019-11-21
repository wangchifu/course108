@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title','複審作業')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('seconds.index') }}">複審作業</a></li>
                    <li class="breadcrumb-item active" aria-current="page">審查 {{ $school_name }}</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    <h4>
                        {{ $course->year }} 學年 {{ $school_name }} 課程計畫-複審作業
                    </h4>
                </div>
                <div class="card-body">
                    @include('layouts.base_course')
                    {{ Form::open(['route'=>'seconds.update','method'=>'patch']) }}
                    <br>
                    <table class="table">
                        <tr class="bg-info">
                            <th colspan="2">
                                複審結果
                            </th>
                            <th colspan="3">
                                審查意見
                            </th>
                        </tr>
                        <tr>
                            <?php
                                if($course->second_result=="ok"){
                                    $select1 = "selected";
                                    $select2 = null;
                                    $select3 = null;
                                    $select4 = null;
                                }
                                if($course->second_result=="excellent1"){
                                    $select1 = null;
                                    $select2 = "selected";
                                    $select3 = null;
                                    $select4 = null;
                                }
                                if($course->second_result=="excellent2"){
                                    $select1 = null;
                                    $select2 = null;
                                    $select3 = "selected";
                                    $select4 = null;
                                }
                                if($course->second_result=="excellent3"){
                                    $select1 = null;
                                    $select2 = null;
                                    $select3 = null;
                                    $select4 = "selected";
                                }
                            ?>
                            <td colspan="2">
                                <select name="second_result" class="form-control" required>
                                    <option value="" disabled>
                                        -----請選擇複審結果-----
                                    </option>
                                    <option value="ok" {{ $select1 }}>
                                        通過，不列入優良學校課程計畫！
                                    </option>
                                    <option value="excellent1" {{ $select2 }}>
                                        讚！列入優良學校課程計畫(特優)
                                    </option>
                                    <option value="excellent2" {{ $select3 }}>
                                        讚！列入優良學校課程計畫(優等)
                                    </option>
                                    <option value="excellent3" {{ $select4 }}>
                                        讚！列入優良學校課程計畫(甲等)
                                    </option>
                                </select>
                            </td>
                            <td colspan="3">
                                <textarea name="second_reason" class="form-control">{{ $course->second_reason }}</textarea>
                            </td>
                        </tr>
                    </table>
                    <a href="#" class="btn btn-secondary btn-sm" onclick="history.back();"><i class="fas fa-backward"></i> 返回</a>
                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('確定儲存？')">
                        <i class="fas fa-save"></i> 儲存設定
                    </button>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
