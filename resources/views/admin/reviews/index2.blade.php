@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title',' 普教審查管理 | ')

@section('content')
    <?php
        for($i=1;$i<8;$i++){
            $active[$i] = null;
        }
        $active[6] = "active";
    ?>
    <div class="row justify-content-center">
        <div class="col-md-3">
            @include('admin.side',['active'=>$active])
        </div>
        <div class="col-md-9">
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
                                {{ Form::open(['route'=>'questions.index','method'=>'post']) }}
                                {{ Form::select('year',$year_items,$select_year,['onchange'=>'submit()']) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    <a href="javascript:open_window2('{{ route('reviews.special_by_user',['select_year'=>$select_year,'special'=>'1']) }}','新視窗')" class="btn btn-info btn-sm"><i class="fas fa-user"></i> 審「身障」委員選學校</a>
                    <a href="javascript:open_window2('{{ route('reviews.special_by_user',['select_year'=>$select_year,'special'=>'2']) }}','新視窗')" class="btn btn-info btn-sm"><i class="far fa-user"></i> 審「資優」委員選學校</a>
                    <a href="javascript:open_window2('{{ route('reviews.special_by_user',['select_year'=>$select_year,'special'=>'3']) }}','新視窗')" class="btn btn-info btn-sm"><i class="far fa-user"></i> 審「藝才」委員選學校</a>
                    <table border="1" width="100%" class="table-striped">
                        <thead>
                        <tr>
                            <th nowrap style="background-color: #c4e1ff">
                                校名
                            </th>
                            <th nowrap>
                                審「身障類」
                            </th>
                            <th nowrap>
                                審「資優類」
                            </th>
                            <th nowrap>
                                審「藝才類」
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr>
                                <td>
                                    {{ $schools[$course->school_code] }} <small>({{ $course->school_code }})</small>
                                </td>
                                <td>
                                    {{ $special1_name[$course->school_code] }}
                                    <a href="javascript:open_window('{{ route('reviews.special1_user',['select_year'=>$select_year,'school_code'=>$course->school_code]) }}','新視窗')"><i class="fas fa-list-ul"></i></a>
                                </td>
                                <td>
                                    {{ $special2_name[$course->school_code] }}
                                    <a href="javascript:open_window('{{ route('reviews.special2_user',['select_year'=>$select_year,'school_code'=>$course->school_code]) }}','新視窗')"><i class="fas fa-list-ul"></i></a>
                                </td>
                                <td>
                                    {{ $special3_name[$course->school_code] }}
                                    <a href="javascript:open_window('{{ route('reviews.special3_user',['select_year'=>$select_year,'school_code'=>$course->school_code]) }}','新視窗')"><i class="fas fa-list-ul"></i></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $courses->links() }}
                </div>
            </div>
        </div>
    </div>
    <script>
        <!--
        function open_window(url,name)
        {
            window.open(url,name,'statusbar=no,scrollbars=yes,status=yes,resizable=yes,width=900,height=180');
        }
        function open_window2(url,name)
        {
            window.open(url,name,'statusbar=no,scrollbars=yes,status=yes,resizable=yes,width=600,height=800');
        }
        // -->
    </script>
@endsection
