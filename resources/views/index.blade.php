@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5>
                        <img src="{{ asset('images/news.svg') }}" height="24">
                        最新消息
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th width="100">
                                發佈日期
                            </th>
                            <th>
                                標題
                            </th>
                            <th width="100">
                                發佈單位
                            </th>
                            <th width="80">
                                瀏覽
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>

                </div>
            </div>
            <hr>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h5>
                        <img src="{{ asset('images/calendar.svg') }}" height="24">
                        審查時間表
                    </h5>
                </div>
                <div class="card-body">
                    <h5> 學年度</h5><hr>
                    <strong>階段1：學校上傳：</strong><br><hr>
                    <strong>階段2：初審作業：</strong><br><hr>
                    <strong>階段2-1：依初審後再傳：</strong><br><hr>
                    <strong>階段2-2：初審後，三傳：</strong><br><hr>
                    <strong>階段3：複審作業：</strong><br><hr>
                    <strong>開放查詢：</strong><br>
                </div>
            </div>
            <hr>
        </div>
    </div>
@endsection
