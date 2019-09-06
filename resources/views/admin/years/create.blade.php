@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title','新增年度')

@section('content')
    <?php
    for($i=1;$i<8;$i++){
        $active[$i] = null;
    }
    $active[2] = "active";
    ?>
    <script src="{{ asset('gijgo/js/gijgo.min.js') }}" type="text/javascript"></script>
    <link href="{{ asset('gijgo/css/gijgo.min.css') }}" rel="stylesheet" type="text/css">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('admin.side',['active'=>$active])
        </div>
        <div class="col-md-9">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('years.index') }}">年度管理</a></li>
                    <li class="breadcrumb-item active" aria-current="page">新增年度</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    <h5>
                        新增年度
                    </h5>
                </div>
                <div class="card-body">
                    @include('layouts.form_errors')
                    {{ Form::open(['route'=>'years.store','method'=>'post']) }}
                    <table>
                        <tr>
                            <td width="33%">
                                <div class="form-group">
                                    <label for="year">年度</label>
                                    {{ Form::text('year',null,['class'=>'form-control','id'=>'year','maxlength'=>'3','required'=>'required']) }}
                                    <small class="form-text text-muted">3碼年度代號</small>
                                </div>
                            </td>
                            <td width="33%">

                            </td>
                            <td width="33%">

                            </td>
                        </tr>
                        <tr bgcolor="#FFDDAA">
                            <td colspan="3">
                                <h4>國小課程設定</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="e1">國小一年級</label>
                                    {{ Form::select('e1',$courses,null,['class'=>'form-control','id'=>'e1','maxlength'=>'3','required'=>'required']) }}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="e2">國小二年級</label>
                                    {{ Form::select('e2',$courses,null,['class'=>'form-control','id'=>'e2','maxlength'=>'3','required'=>'required']) }}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="e3">國小三年級</label>
                                    {{ Form::select('e3',$courses,null,['class'=>'form-control','id'=>'e3','maxlength'=>'3','required'=>'required']) }}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="e5">國小四年級</label>
                                    {{ Form::select('e4',$courses,null,['class'=>'form-control','id'=>'e4','maxlength'=>'3','required'=>'required']) }}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="e5">國小五年級</label>
                                    {{ Form::select('e5',$courses,null,['class'=>'form-control','id'=>'e5','maxlength'=>'3','required'=>'required']) }}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="e6">國小六年級</label>
                                    {{ Form::select('e6',$courses,null,['class'=>'form-control','id'=>'e6','maxlength'=>'3','required'=>'required']) }}
                                </div>
                            </td>
                        </tr>
                        <tr bgcolor="#CCEEFF">
                            <td colspan="3">
                                <h4>國中課程設定</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="j1">國中一年級</label>
                                    {{ Form::select('j1',$courses,null,['class'=>'form-control','id'=>'j1','maxlength'=>'3','required'=>'required']) }}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="j2">國中二年級</label>
                                    {{ Form::select('j2',$courses,null,['class'=>'form-control','id'=>'j2','maxlength'=>'3','required'=>'required']) }}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="j3">國中三年級</label>
                                    {{ Form::select('j3',$courses,null,['class'=>'form-control','id'=>'j3','maxlength'=>'3','required'=>'required']) }}
                                </div>
                            </td>
                        </tr>
                        <tr bgcolor="#FFCCCC">
                            <td colspan="3">
                                <h4>各階段日期區間設定(例：2018-06-04)</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="step1_date1">階段1：學校上傳開始日</label>
                                    <input id="step1_date1" width="276" name="step1_date1" required maxlength="10" value="{{ old('step1_date1') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step1_date1').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="step1_date2">階段1：學校上傳結束日</label>
                                    <input id="step1_date2" width="276" name="step1_date2" required maxlength="10" value="{{ old('step1_date2') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step1_date2').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="step2_date1">階段2：初審作業開始日</label>
                                    <input id="step2_date1" width="276" name="step2_date1" required maxlength="10" value="{{ old('step2_date1') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step2_date1').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="step2_date2">階段2：初審作業結束日</label>
                                    <input id="step2_date2" width="276" name="step2_date2" required maxlength="10" value="{{ old('step2_date2') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step2_date2').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="step2_1_date1">階段2-1：依初審意見修正，再次上傳開始日</label>
                                    <input id="step2_1_date1" width="276" name="step2_1_date1" required maxlength="10" value="{{ old('step2_1_date1') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step2_1_date1').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="step2_1_date2">階段2-1：依初審意見修正，再次上傳結束日</label>
                                    <input id="step2_1_date2" width="276" name="step2_1_date2" required maxlength="10" value="{{ old('step2_1_date2') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step2_1_date2').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="step2_2_date1">階段2-2：初審未通過，第三次上傳開始日</label>
                                    <input id="step2_2_date1" width="276" name="step2_2_date1" required maxlength="10" value="{{ old('step2_2_date1') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step2_2_date1').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="step2_2_date2">階段2-2：初審未通過，第三次上傳結束日</label>
                                    <input id="step2_2_date2" width="276" name="step2_2_date2" required maxlength="10" value="{{ old('step2_2_date2') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step2_2_date2').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="step3_date1">階段3：複審作業開始日</label>
                                    <input id="step3_date1" width="276" name="step3_date1" required maxlength="10" value="{{ old('step3_date1') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step3_date1').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="step3_date2">階段3：複審作業結束日</label>
                                    <input id="step3_date2" width="276" name="step3_date2" required maxlength="10" value="{{ old('step3_date2') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step3_date2').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label for="step4_date1">階段4：開放查詢訂開始日</label>
                                    <input id="step4_date1" width="276" name="step4_date1" required maxlength="10" value="{{ old('step4_date1') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step4_date1').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <label for="step4_date2">階段4：開放查詢訂結束日</label>
                                    <input id="step4_date2" width="276" name="step4_date2" required maxlength="10" value="{{ old('step4_date2') }}">
                                    <script src="{{ asset('gijgo/js/messages/messages.zh-TW.js') }}"></script>
                                    <script>
                                        $('#step4_date2').datepicker({
                                            uiLibrary: 'bootstrap4',
                                            format: 'yyyy-mm-dd',
                                            locale: 'zh-TW',
                                        });
                                    </script>
                                </div>
                            </td>
                            <td>

                            </td>
                        </tr>
                    </table>
                    <div class="form-group">
                        <a href="#" class="btn btn-secondary btn-sm" onclick="history.back();"><i class="fas fa-backward"></i> 返回</a>
                        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('確定儲存？')">
                            <i class="fas fa-save"></i> 儲存設定
                        </button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
