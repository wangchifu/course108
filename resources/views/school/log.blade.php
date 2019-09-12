@extends('layouts.master_clean')
@section('title','學校動作記錄檔 | ')
@section('content')
<table class="table table-striped">
    <thead class="thead-light">
    <tr>
        <th>
            <i class="fas fa-arrow-up"></i> 時間
        </th>
        <th>
            使用者
        </th>
        <th>
            動作
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($logs as $log)
    <tr>
        <td>
            {{ $log->created_at }}
        </td>
        <td>
            {{ $log->user->school }} {{ $log->user->title }} {{ $log->user->name }}
        </td>
        <td>
            {{ $log->event }}
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@endsection
