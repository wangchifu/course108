@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title','特教審核')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('specials.index') }}">特教審核</a></li>
                    <li class="breadcrumb-item active" aria-current="page">審查 {{ $school_name }}</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-header">
                    <h4>
                        {{ $special_review->year }} 學年 {{ $school_name }} 課程計畫-特教審查
                    </h4>
                </div>
                <div class="card-body">
                    <h3>
                        {{ $special_review->question->title }}
                    </h3>
                    <?php
                        $question = $special_review->question;
                        $select_year = $special_review->question->year;
                        $school_code = $special_review->school_code;
                        $upload = \App\Upload::where('question_id',$question->id)
                            ->where('code',$school_code)
                            ->first();
                    ?>
                    @if($upload)
                        @if($question->type=="1")
                            <?php
                            $file_path = $select_year.'&&'.$school_code.'&&'.$question->id.'&&'.$upload->file;
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
                                $file_path = $select_year.'&&'.$school_code.'&&'.$question->id.'&&'.$file;
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
                                            @if($school_group=="1")
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
                                            @elseif($school_group=="2")
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
                                                @if($school_group==1)
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
                                                @else($school_group==2)
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
                                                @if($school_group=="1")
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
                                                @elseif($school_group=="2")
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
                                        @if($school_group=="1")
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
                                                            $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$f[1];
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
                                                            $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$f[2];
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
                                                            $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$f[3];
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
                                                            $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$f[4];
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
                                                            $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$f[5];
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
                                                            $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$f[6];
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
                                        @if($school_group=="2")
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
                                                            $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$f[7];
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
                                                            $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$f[8];
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
                                                            $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$f[9];
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
                                        @if($school_group=="1")
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
                                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
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
                                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
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
                                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
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
                                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
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
                                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
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
                                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
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
                                        @if($school_group=="2")
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
                                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
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
                                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
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
                                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
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


                                        @endif
                        @if($question->type=="8")
                                            <span class="text-primary"><i class="fas fa-calendar"></i> {{ $upload->file }}</span>
                                        @endif
                    @else
                         <span class="text-danger">尚未上傳</span>
                    @endif
                    <hr>
                    <?php
                    $special_suggest = \App\SpecialSuggest::where('question_id',$special_review->question->id)
                        ->where('school_code',$special_review->school_code)
                        ->first();
                    if($special_suggest){
                        if($special_suggest->pass=="1"){
                            $check1 = "checked";
                            $check2 = null;
                    }
                        if($special_suggest->pass=="0"){
                            $check1 = null;
                            $check2 = "checked";
                        }
                        $suggest = $special_suggest->suggest;
                    }else{
                        $check1 = "checked";
                        $check2 = null;
                        $suggest = null;
                    }

                    ?>
                    @if($upload)
                    {{ Form::open(['route'=>'specials.store','method'=>'post']) }}
                    <input type="hidden" name="question_id" value="{{ $special_review->question_id }}">
                    <input type="hidden" name="school_code" value="{{ $special_review->school_code }}">
                    <input type="radio" name="pass" id="check1" value="1" {{ $check1 }}> <label for="check1">符合</label>　
                    <input type="radio" name="pass" id="check2" value="0" {{ $check2 }}> <label for="check2">不符合</label>
                    <br>
                    <textarea name="suggest" class="form-control" placeholder="請填評語">{{ $suggest }}</textarea>
                    <br>
                    <button onclick="history.back()" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</button>
                    <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('確定儲存？')">
                        <i class="fas fa-save"></i> 儲存設定
                    </button>
                    {{ Form::close() }}
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
