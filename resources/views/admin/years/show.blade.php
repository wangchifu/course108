@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title','年度詳細資料')

@section('content')
    <?php
    for($i=1;$i<8;$i++){
        $active[$i] = null;
    }
    $active[2] = "active";
    ?>
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('admin.side',['active'=>$active])
        </div>
        <div class="col-md-9">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('years.index') }}">年度管理</a></li>
                    <li class="breadcrumb-item active" aria-current="page">年度詳細內容</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    <h5>
                        <img src="{{ asset('images/year.svg') }}" height="24">
                        {{ $year->year }}年度詳細
                    </h5>
                </div>
                <div class="card-body">
                    <a href="#" class="badge badge-secondary" onclick="history.back();"><i class="fas fa-backward"></i> 返回</a>
                    <a href="{{ route('years.edit',$year->id) }}"><span class="badge badge-primary"><i class="fas fa-edit"></i> 編輯</span></a>
                    <a href="{{ route('years.destroy',$year->id) }}" onclick="return confirm('確定刪除？該年度所有學校的所有資料將一併刪除喔！')"><span class="badge badge-danger"><i class="fas fa-trash"></i> 刪除</span></a>
                    <div class="form-group">
                        <label for="year">年度</label>
                        <strong class="text-primary">{{ $year->year }}</strong>
                    </div>
                    <div class="form-group">
                        <label for="e1">國小一年級課程</label>
                        @if($year->e1=="9year")
                            <strong class="text-primary">九年一貫課程</strong>
                        @else
                            <strong class="text-success">十二年國教課程</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="e2">國小二年級課程</label>
                        @if($year->e2=="9year")
                            <strong class="text-primary">九年一貫課程</strong>
                        @else
                            <strong class="text-success">十二年國教課程</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="e3">國小三年級課程</label>
                        @if($year->e3=="9year")
                            <strong class="text-primary">九年一貫課程</strong>
                        @else
                            <strong class="text-success">十二年國教課程</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="e4">國小四年級課程</label>
                        @if($year->e4=="9year")
                            <strong class="text-primary">九年一貫課程</strong>
                        @else
                            <strong class="text-success">十二年國教課程</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="e5">國小五年級課程</label>
                        @if($year->e5=="9year")
                            <strong class="text-primary">九年一貫課程</strong>
                        @else
                            <strong class="text-success">十二年國教課程</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="e6">國小六年級課程</label>
                        @if($year->e6=="9year")
                            <strong class="text-primary">九年一貫課程</strong>
                        @else
                            <strong class="text-success">十二年國教課程</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="j1">國中一年級課程</label>
                        @if($year->j1=="9year")
                            <strong class="text-primary">九年一貫課程</strong>
                        @else
                            <strong class="text-success">十二年國教課程</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="j2">國中二年級課程</label>
                        @if($year->j2=="9year")
                            <strong class="text-primary">九年一貫課程</strong>
                        @else
                            <strong class="text-success">十二年國教課程</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="j3">國中三年級課程</label>
                        @if($year->j3=="9year")
                            <strong class="text-primary">九年一貫課程</strong>
                        @else
                            <strong class="text-success">十二年國教課程</strong>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>階段1：學校上傳開始上傳日期區間</label>
                        <strong class="text-primary">{{ $year->step1_date1 }}</strong>
                        至
                        <strong class="text-primary">{{ $year->step1_date2 }}</strong>
                    </div>
                    <div class="form-group">
                        <label>階段2：初審作業日期區間</label>
                        <strong class="text-primary">{{ $year->step2_date1 }}</strong>
                        至
                        <strong class="text-primary">{{ $year->step2_date2 }}</strong>
                    </div>
                    <div class="form-group">
                        <label>階段2-1：依初審意見修正，再次上傳日期區間</label>
                        <strong class="text-primary">{{ $year->step2_1_date1 }}</strong>
                        至
                        <strong class="text-primary">{{ $year->step2_1_date2 }}</strong>
                    </div>
                    <div class="form-group">
                        <label>階段2-2：依初審意見修正，第三次上傳日期區間</label>
                        <strong class="text-primary">{{ $year->step2_2_date1 }}</strong>
                        至
                        <strong class="text-primary">{{ $year->step2_2_date2 }}</strong>
                    </div>
                    <div class="form-group">
                        <label>階段3：複審作業日期區間</label>
                        <strong class="text-primary">{{ $year->step3_date1 }}</strong>
                        至
                        <strong class="text-primary">{{ $year->step3_date2 }}</strong>
                    </div>
                    <div class="form-group">
                        <label>階段4：開放查詢日期區間</label>
                        <strong class="text-primary">{{ $year->step4_date1 }}</strong>
                        至
                        <strong class="text-primary">{{ $year->step4_date2 }}</strong>
                    </div>
                    <a href="#" class="btn btn-secondary btn-sm" onclick="history.back();"><i class="fas fa-backward"></i> 返回</a>
                </div>
            </div>
        </div>
    </div>
@endsection
