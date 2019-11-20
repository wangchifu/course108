@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title','學校專區 | ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
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
                    <a href="{{ route('schools.show_log',$select_year) }}" class="btn btn-info btn-sm" target="_blank"><i class="fas fa-eye"></i> 檢視上傳歷程</a>
                    @if(check_in_date($select_year))
                        @if($course->first_result1==null)
                            <a href="{{ route('schools.edit',$select_year) }}" class="btn btn-success btn-sm"><i class="fas fa-upload"></i> 上傳普教課程</a>
                        @endif
                        @if($course->special_result==null)
                            <a href="{{ route('schools.edit2',$select_year) }}" class="btn btn-outline-success btn-sm"><i class="fas fa-upload"></i> 上傳特教課程</a>
                        @endif
                    @endif
                    <br><br>
                    <table class="table table-striped">
                        <tr>
                            <th colspan="5">
                                課程首次上傳<br>
                                <small>{{ $year->step1_date1 }}~{{$year->step1_date2}}</small>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                普教初審<br>
                                <small>{{ $year->step2_date1 }}~{{$year->step2_date2}}</small>
                            </th>
                            <th>
                                普教初審-再傳<br>
                                <small>{{ $year->step2_1_date1 }}~{{$year->step2_1_date2}}</small>
                            </th>
                            <th>
                                普教初審-三傳<br>
                                <small>{{ $year->step2_2_date1 }}~{{$year->step2_2_date2}}</small>
                            </th>
                            <th>
                                特教審查
                            </th>
                            <th>
                                普教複審<br>
                                <small>{{ $year->step3_date1 }}~{{$year->step3_date2}}</small>
                            </th>
                        </tr>
                        <tr>
                            <td>
                                @if($course->first_result1==null)
                                    <span class="text-danger">未送審</span>
                                @endif
                                @if($course->first_result1=="submit")
                                    <span>已送審</span>
                                @endif
                            </td>
                            <td>
                                2
                            </td>
                            <td>
                                3
                            </td>
                            <td>
                                @if($course->special_result==null)
                                    <span class="text-warning">未送審</span>
                                @endif
                                @if($course->special_result=="submit")
                                    <span class="text-primary">已送審</span>
                                @endif

                            </td>
                            <td>
                                5
                            </td>
                        </tr>
                    </table>
                    <h1>{{ auth()->user()->school }} {{ $select_year }}學年度課程計畫</h1>
                    <table border="1">
                        @foreach($parts as $part)
                            <tr bgcolor="#cccccc">
                                <td>
                                    {{ $part_order_by[$part->order_by] }}
                                </td>
                                <td>
                                    {{ $part->title }}
                                </td>
                                <td width="120">
                                    狀況
                                </td>
                            </tr>
                            @foreach($part->topics as $topic)
                                <tr>
                                    <td colspan="3">
                                        {{ $topic->order_by }}.{{ $topic->title }}
                                    </td>
                                </tr>

                                @foreach($topic->questions as $question)
                                    <?php
                                    $upload = \App\Upload::where('question_id',$question->id)
                                        ->where('code',auth()->user()->code)
                                        ->first();
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td valign="top">
                                            {{ $question->order_by }} {{ $question->title }}
                                        </td>
                                        <td>
                                            @if($upload)
                                                @if($question->type=="1")
                                                <?php
                                                $file_path = $select_year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$upload->file;
                                                ?>
                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                    <i class="fas fa-eye"></i> 檢視檔案
                                                </a>
                                                @endif
                                                @if($question->type=="2")
                                                    <?php
                                                        $files = explode(',',$upload->file);
                                                        $i=1;
                                                    ?>
                                                    @foreach($files as $file)
                                                        <?php
                                                            $file_path = $select_year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$file;
                                                        ?>
                                                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                            <i class="fas fa-eye"></i> 檢視檔案 {{ $i }}
                                                        </a><br>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                @endif
                                                @if($question->type=="3")
                                                    </td>
                                                    </tr>
                                                    <td></td>
                                                    <td colspan="2">
                                                        <?php
                                                        $area_section = unserialize($upload->file);
                                                        ?>
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
                                                    <br>
                                                @endif
                                                @if($question->type=="4")
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                    <td></td>
                                                    <td colspan="2">
                                                        <?php
                                                        if($upload){
                                                            $area_file = unserialize($upload->file);
                                                        }else{
                                                            $area_file = [];
                                                        }
                                                        ?>
                                                        <table>
                                                            <tr valign="top">
                                                                @if(auth()->user()->group_id==1)
                                                                    <td valign="top">
                                                                        @if(!empty($year12))
                                                                            <strong>國小十二年國教課程</strong>
                                                                            @include('school.upload4_e12_ok')
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        　
                                                                    </td>
                                                                    <td>
                                                                        @if(!empty($year9))
                                                                            <strong>國小九年一貫課程</strong>
                                                                            @include('school.upload4_e9_ok')
                                                                        @endif
                                                                    </td>
                                                                @else(auth()->user()->group_id==2)
                                                                    <td valign="top">
                                                                        @if(!empty($year12))
                                                                            <strong>國中十二年國教課程</strong>
                                                                            @include('school.upload4_j12_ok')
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        　
                                                                    </td>
                                                                    <td>
                                                                        @if(!empty($year9))
                                                                            <strong>國中九年一貫課程</strong>
                                                                            @include('school.upload4_j9_ok')
                                                                        @endif
                                                                    </td>
                                                                @endif
                                                            </tr>
                                                        </table>
                                                        <br>
                                                @endif
                                                @if($question->type=="5")
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="2">
                                                            <?php
                                                            $book = unserialize($upload->file);
                                                            ?>
                                                            <table>
                                                                <tr valign="top">
                                                                    @if(auth()->user()->group_id=="1")
                                                                        <td valign="top">
                                                                            @if(!empty($year12))
                                                                                <strong>國小十二年國教課程</strong>
                                                                                @include('school.book_e12_ok')
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            　
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($year9))
                                                                                <strong>國小九年一貫課程</strong>
                                                                                @include('school.book_e9_ok')
                                                                            @endif
                                                                        </td>
                                                                    @elseif(auth()->user()->group_id=="2")
                                                                        <td valign="top">
                                                                            @if(!empty($year12))
                                                                                <strong>國中十二年國教課程</strong>
                                                                                @include('school.book_j12_ok')
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            　
                                                                        </td>
                                                                        <td>
                                                                            @if(!empty($year9))
                                                                                <strong>國中九年一貫課程</strong>
                                                                                @include('school.book_j9_ok')
                                                                            @endif
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            </table>
                                                            <br>
                                                @endif
                                                @if($question->type=="6")
                                                        <?php
                                                        $f = ['1'=>'','2'=>'','3'=>'','4'=>'','5'=>'','6'=>'','7'=>'','8'=>'','9'=>''];
                                                        if($upload and $upload->file != null){
                                                            $check_f = unserialize($upload->file);
                                                            //填入
                                                            foreach($f as $k=>$v){
                                                                if(isset($check_f[$k])) $f[$k] = $check_f[$k];
                                                            }
                                                        }
                                                        ?>
                                                    </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="2">
                                                            @if(auth()->user()->group_id=="1")
                                                                <table border="1">
                                                                    <tr>
                                                                        <td>
                                                                            年級
                                                                        </td>
                                                                        <td>
                                                                            一年級
                                                                        </td>
                                                                        <td>
                                                                            二年級
                                                                        </td>
                                                                        <td>
                                                                            三年級
                                                                        </td>
                                                                        <td>
                                                                            四年級
                                                                        </td>
                                                                        <td>
                                                                            五年級
                                                                        </td>
                                                                        <td>
                                                                            六年級
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            單檔
                                                                        </td>
                                                                        <td>
                                                                            @if($f[1])
                                                                                <?php
                                                                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[1];
                                                                                ?>
                                                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                    <i class="fas fa-eye"></i> 檢視檔案
                                                                                </a>
                                                                            @else
                                                                                @if($question->need)
                                                                                    <span class="text-danger">未上傳</span>
                                                                                @else
                                                                                    <span class="text-warning">非必填</span>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($f[2])
                                                                                <?php
                                                                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[2];
                                                                                ?>
                                                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                    <i class="fas fa-eye"></i> 檢視檔案
                                                                                </a>
                                                                            @else
                                                                                @if($question->need)
                                                                                    <span class="text-danger">未上傳</span>
                                                                                @else
                                                                                    <span class="text-warning">非必填</span>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($f[3])
                                                                                <?php
                                                                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[3];
                                                                                ?>
                                                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                    <i class="fas fa-eye"></i> 檢視檔案
                                                                                </a>
                                                                            @else
                                                                                @if($question->need)
                                                                                    <span class="text-danger">未上傳</span>
                                                                                @else
                                                                                    <span class="text-warning">非必填</span>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($f[4])
                                                                                <?php
                                                                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[4];
                                                                                ?>
                                                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                    <i class="fas fa-eye"></i> 檢視檔案
                                                                                </a>
                                                                            @else
                                                                                @if($question->need)
                                                                                    <span class="text-danger">未上傳</span>
                                                                                @else
                                                                                    <span class="text-warning">非必填</span>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($f[5])
                                                                                <?php
                                                                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[5];
                                                                                ?>
                                                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                    <i class="fas fa-eye"></i> 檢視檔案
                                                                                </a>
                                                                            @else
                                                                                @if($question->need)
                                                                                    <span class="text-danger">未上傳</span>
                                                                                @else
                                                                                    <span class="text-warning">非必填</span>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($f[6])
                                                                                <?php
                                                                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[6];
                                                                                ?>
                                                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                    <i class="fas fa-eye"></i> 檢視檔案
                                                                                </a>
                                                                            @else
                                                                                @if($question->need)
                                                                                    <span class="text-danger">未上傳</span>
                                                                                @else
                                                                                    <span class="text-warning">非必填</span>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            @endif
                                                            @if(auth()->user()->group_id=="2")
                                                                <table border="1">
                                                                    <tr>
                                                                        <td>
                                                                            年級
                                                                        </td>
                                                                        <td>
                                                                            七年級
                                                                        </td>
                                                                        <td>
                                                                            八年級
                                                                        </td>
                                                                        <td>
                                                                            九年級
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            單檔
                                                                        </td>
                                                                        <td>
                                                                            @if($f[7])
                                                                                <?php
                                                                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[7];
                                                                                ?>
                                                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                    <i class="fas fa-eye"></i> 檢視檔案
                                                                                </a>
                                                                            @else
                                                                                @if($question->need)
                                                                                    <span class="text-danger">未上傳</span>
                                                                                @else
                                                                                    <span class="text-warning">非必填</span>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($f[8])
                                                                                <?php
                                                                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[8];
                                                                                ?>
                                                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                    <i class="fas fa-eye"></i> 檢視檔案
                                                                                </a>
                                                                            @else
                                                                                @if($question->need)
                                                                                    <span class="text-danger">未上傳</span>
                                                                                @else
                                                                                    <span class="text-warning">非必填</span>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if($f[9])
                                                                                <?php
                                                                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[9];
                                                                                ?>
                                                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                    <i class="fas fa-eye"></i> 檢視檔案
                                                                                </a>
                                                                            @else
                                                                                @if($question->need)
                                                                                    <span class="text-danger">未上傳</span>
                                                                                @else
                                                                                    <span class="text-warning">非必填</span>
                                                                                @endif
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            @endif
                                                        <br>
                                                @endif
                                                @if($question->type=="7")
                                                        </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td colspan="2">
                                                                <?php
                                                                $f = ['1'=>'','2'=>'','3'=>'','4'=>'','5'=>'','6'=>'','7'=>'','8'=>'','9'=>''];
                                                                if($upload and $upload->file != null){
                                                                    $check_f = unserialize($upload->file);
                                                                }else{
                                                                    $check_f = [];
                                                                }
                                                                ?>
                                                                @if(auth()->user()->group_id=="1")
                                                                    <table border="1">
                                                                        <tr>
                                                                            <td>
                                                                                年級
                                                                            </td>
                                                                            <td>
                                                                                一年級
                                                                            </td>
                                                                            <td>
                                                                                二年級
                                                                            </td>
                                                                            <td>
                                                                                三年級
                                                                            </td>
                                                                            <td>
                                                                                四年級
                                                                            </td>
                                                                            <td>
                                                                                五年級
                                                                            </td>
                                                                            <td>
                                                                                六年級
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                多檔
                                                                            </td>
                                                                            <td valign="top">
                                                                                @if(isset($check_f[1]))
                                                                                    @foreach($check_f[1] as $k=>$v)
                                                                                        <?php
                                                                                        $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                                                                        ?>
                                                                                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                            <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                                                                        </a>
                                                                                        <br>
                                                                                    @endforeach
                                                                                @else
                                                                                    @if($question->need=="1")
                                                                                        <span class="text-danger">未上傳多檔</span>
                                                                                    @else
                                                                                        <span class="text-warning">未上傳多檔</span>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td valign="top">
                                                                                @if(isset($check_f[2]))
                                                                                    @foreach($check_f[2] as $k=>$v)
                                                                                        <?php
                                                                                        $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                                                                        ?>
                                                                                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                            <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                                                                        </a>
                                                                                        <br>
                                                                                    @endforeach
                                                                                @else
                                                                                    @if($question->need=="1")
                                                                                        <span class="text-danger">未上傳多檔</span>
                                                                                    @else
                                                                                        <span class="text-warning">未上傳多檔</span>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td valign="top">
                                                                                @if(isset($check_f[3]))
                                                                                    @foreach($check_f[3] as $k=>$v)
                                                                                        <?php
                                                                                        $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                                                                        ?>
                                                                                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                            <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                                                                        </a>
                                                                                        <br>
                                                                                    @endforeach
                                                                                @else
                                                                                    @if($question->need=="1")
                                                                                        <span class="text-danger">未上傳多檔</span>
                                                                                    @else
                                                                                        <span class="text-warning">未上傳多檔</span>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td valign="top">
                                                                                @if(isset($check_f[4]))
                                                                                    @foreach($check_f[4] as $k=>$v)
                                                                                        <?php
                                                                                        $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                                                                        ?>
                                                                                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                            <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                                                                        </a>
                                                                                        <br>
                                                                                    @endforeach
                                                                                @else
                                                                                    @if($question->need=="1")
                                                                                        <span class="text-danger">未上傳多檔</span>
                                                                                    @else
                                                                                        <span class="text-warning">未上傳多檔</span>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td valign="top">
                                                                                @if(isset($check_f[5]))
                                                                                    @foreach($check_f[5] as $k=>$v)
                                                                                        <?php
                                                                                        $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                                                                        ?>
                                                                                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                            <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                                                                        </a>
                                                                                        <br>
                                                                                    @endforeach
                                                                                @else
                                                                                    @if($question->need=="1")
                                                                                        <span class="text-danger">未上傳多檔</span>
                                                                                    @else
                                                                                        <span class="text-warning">未上傳多檔</span>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td valign="top">
                                                                                @if(isset($check_f[6]))
                                                                                    @foreach($check_f[6] as $k=>$v)
                                                                                        <?php
                                                                                        $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                                                                        ?>
                                                                                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                            <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                                                                        </a>
                                                                                        <br>
                                                                                    @endforeach
                                                                                @else
                                                                                    @if($question->need=="1")
                                                                                        <span class="text-danger">未上傳多檔</span>
                                                                                    @else
                                                                                        <span class="text-warning">未上傳多檔</span>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                    <br>
                                                                @endif
                                                                @if(auth()->user()->group_id=="2")
                                                                    <table border="1">
                                                                        <tr>
                                                                            <td>
                                                                                年級
                                                                            </td>
                                                                            <td>
                                                                                七年級
                                                                            </td>
                                                                            <td>
                                                                                八年級
                                                                            </td>
                                                                            <td>
                                                                                九年級
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                多檔
                                                                            </td>
                                                                            <td valign="top">
                                                                                @if(isset($check_f[7]))
                                                                                    @foreach($check_f[7] as $k=>$v)
                                                                                        <?php
                                                                                        $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                                                                        ?>
                                                                                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                            <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                                                                        </a>
                                                                                        <br>
                                                                                    @endforeach
                                                                                @else
                                                                                    @if($question->need=="1")
                                                                                        <span class="text-danger">未上傳多檔</span>
                                                                                    @else
                                                                                        <span class="text-warning">未上傳多檔</span>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td valign="top">
                                                                                @if(isset($check_f[8]))
                                                                                    @foreach($check_f[8] as $k=>$v)
                                                                                        <?php
                                                                                        $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                                                                        ?>
                                                                                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                            <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                                                                        </a>
                                                                                        <br>
                                                                                    @endforeach
                                                                                @else
                                                                                    @if($question->need=="1")
                                                                                        <span class="text-danger">未上傳多檔</span>
                                                                                    @else
                                                                                        <span class="text-warning">未上傳多檔</span>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                            <td valign="top">
                                                                                @if(isset($check_f[9]))
                                                                                    @foreach($check_f[9] as $k=>$v)
                                                                                        <?php
                                                                                        $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                                                                        ?>
                                                                                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                                                            <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                                                                        </a>
                                                                                        <br>
                                                                                    @endforeach
                                                                                @else
                                                                                    @if($question->need=="1")
                                                                                        <span class="text-danger">未上傳多檔</span>
                                                                                    @else
                                                                                        <span class="text-warning">未上傳多檔</span>
                                                                                    @endif
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                @endif
                                                @if($question->type=="8")
                                                    <span class="text-primary"><i class="fas fa-calendar"></i> {{ $upload->file }}</span>
                                                @endif
                                            @else
                                                @if($question->need)
                                                    <span class="text-danger">未上傳</span>
                                                @else
                                                    <span class="text-warning">非必填</span>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
