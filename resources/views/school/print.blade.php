<!doctype html>
<html>
<head>
    <title>
        彰化{{ auth()->user()->school }} {{ $year->year }}學年度 課程計畫-學習領域節數一覽表
    </title>
    @include('layouts.head')
</head>
<body onload="window.print()">
<center>
    <h2>彰化{{ auth()->user()->school }} {{ $year->year }}學年度 課程計畫-學習領域節數一覽表</h2>
    <hr>
    <table>
        <tr valign="top">
            @if(auth()->user()->group_id=="1")
                <td valign="top">
                    @if(!empty($year12))
                        <strong>國小十二年國教課程</strong>
                        @include('school.section_e12_ok')
                    @endif
                </td>
                <td>
                    　
                </td>
                <td>
                    @if(!empty($year9))
                        <strong>國小九年一貫課程</strong>
                        @include('school.section_e9_ok')
                    @endif
                </td>
            @elseif(auth()->user()->group_id=="2")
                <td valign="top">
                    @if(!empty($year12))
                        <strong>國中十二年國教課程</strong>
                        @include('school.section_j12_ok')
                    @endif
                </td>
                <td>
                    　
                </td>
                <td>
                    @if(!empty($year9))
                        <strong>國中九年一貫課程</strong>
                        @include('school.section_j9_ok')
                    @endif
                </td>
            @endif
        </tr>
    </table>
    <hr>
    <div class="row">
        <div class="col-4">
            <h3>承辦人：</h3>
        </div>
        <div class="col-4">
            <h3>主任：</h3>
        </div>
        <div class="col-4">
            <h3>校長：</h3>
        </div>
    </div>
</center>
