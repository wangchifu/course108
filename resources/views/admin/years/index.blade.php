@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title','年度 | ')

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
            <div class="card">
                <div class="card-header">
                    <h5>
                        <img src="{{ asset('images/year.svg') }}" height="24">
                        年度列表
                    </h5>
                </div>
                <div class="card-body">
                    <a href="{{ route('years.create') }}" class="btn btn-success btn-sm"><i class="fas fa-plus"></i> 新增年度</a>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>
                                年度
                            </th>
                            <th>
                                小一
                            </th>
                            <th>
                                小二
                            </th>
                            <th>
                                小三
                            </th>
                            <th>
                                小四
                            </th>
                            <th>
                                小五
                            </th>
                            <th>
                                小六
                            </th>
                            <th>
                                國一
                            </th>
                            <th>
                                國二
                            </th>
                            <th>
                                國三
                            </th>
                            <th>
                                其他
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($years as $year)
                            <tr>
                                <td>
                                    {{ $year->year }}
                                </td>
                                <td>
                                    @if($year->e1=="12year")
                                        <span class="text-success">{{ $year->e1 }}</span>
                                    @else
                                        <span class="text-primary">{{ $year->e1 }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($year->e2=="12year")
                                        <span class="text-success">{{ $year->e2 }}</span>
                                    @else
                                        <span class="text-primary">{{ $year->e2 }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($year->e3=="12year")
                                        <span class="text-success">{{ $year->e3 }}</span>
                                    @else
                                        <span class="text-primary">{{ $year->e3 }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($year->e4=="12year")
                                        <span class="text-success">{{ $year->e4 }}</span>
                                    @else
                                        <span class="text-primary">{{ $year->e4 }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($year->e5=="12year")
                                        <span class="text-success">{{ $year->e5 }}</span>
                                    @else
                                        <span class="text-primary">{{ $year->e5 }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($year->e6=="12year")
                                        <span class="text-success">{{ $year->e6 }}</span>
                                    @else
                                        <span class="text-primary">{{ $year->e6 }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($year->j1=="12year")
                                        <span class="text-success">{{ $year->j1 }}</span>
                                    @else
                                        <span class="text-primary">{{ $year->j1 }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($year->j2=="12year")
                                        <span class="text-success">{{ $year->j2 }}</span>
                                    @else
                                        <span class="text-primary">{{ $year->j2 }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if($year->j3=="12year")
                                        <span class="text-success">{{ $year->j3 }}</span>
                                    @else
                                        <span class="text-primary">{{ $year->j3 }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('years.show',$year->id) }}" class="btn btn-info btn-sm">詳細</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
