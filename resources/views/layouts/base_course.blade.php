<h1>{{ $school_name }} {{ $select_year }}學年度課程計畫</h1>
<table border="1" class="table-striped">
    @foreach($parts as $part)
        <tr bgcolor="#cccccc">
            <td>
                {{ $part_order_by[$part->order_by] }}
            </td>
            <td>
                {{ $part->title }}
            </td>
            <td>
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
                    ->where('code',$school_code)
                    ->first();
                ?>
                <tr>
                    <td></td>
                    <td valign="top">
                        {{ $question->order_by }} {{ $question->title }}
                    </td>
                    <td nowrapf>
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
                                        <?php $i=1; ?>
                                            @foreach($check_f[1] as $k=>$v)
                                                <?php
                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
                                                ?>
                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                    <i class="fas fa-eye"></i> 檔案{{ $i }}
                                                </a>
                                                <br>
                                                <?php $i++; ?>
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
                                            <?php $i=1; ?>
                                            @foreach($check_f[2] as $k=>$v)
                                                <?php
                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
                                                ?>
                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                    <i class="fas fa-eye"></i> 檔案{{ $i }}
                                                </a>
                                                <br>
                                                    <?php $i++; ?>
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
                                            <?php $i=1; ?>
                                            @foreach($check_f[3] as $k=>$v)
                                                <?php
                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
                                                ?>
                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                    <i class="fas fa-eye"></i> 檔案{{ $i }}
                                                </a>
                                                <br>
                                                    <?php $i++; ?>
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
                                            <?php $i=1; ?>
                                            @foreach($check_f[4] as $k=>$v)
                                                <?php
                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
                                                ?>
                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                    <i class="fas fa-eye"></i> 檔案{{ $i }}
                                                </a>
                                                <br>
                                                    <?php $i++; ?>
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
                                            <?php $i=1; ?>
                                            @foreach($check_f[5] as $k=>$v)
                                                <?php
                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
                                                ?>
                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                    <i class="fas fa-eye"></i> 檔案{{ $i }}
                                                </a>
                                                <br>
                                                    <?php $i++; ?>
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
                                            <?php $i=1; ?>
                                            @foreach($check_f[6] as $k=>$v)
                                                <?php
                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
                                                ?>
                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                    <i class="fas fa-eye"></i> 檔案{{ $i }}
                                                </a>
                                                <br>
                                                    <?php $i++; ?>
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
                                            <?php $i=1; ?>
                                            @foreach($check_f[7] as $k=>$v)
                                                <?php
                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
                                                ?>
                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                    <i class="fas fa-eye"></i> 檔案{{ $i }}
                                                </a>
                                                <br>
                                                    <?php $i++; ?>
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
                                            <?php $i=1; ?>
                                            @foreach($check_f[8] as $k=>$v)
                                                <?php
                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
                                                ?>
                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                    <i class="fas fa-eye"></i> 檔案{{ $i }}
                                                </a>
                                                <br>
                                                    <?php $i++; ?>
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
                                            <?php $i=1; ?>
                                            @foreach($check_f[9] as $k=>$v)
                                                <?php
                                                $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$v;
                                                ?>
                                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                                    <i class="fas fa-eye"></i> 檔案{{ $i }}
                                                </a>
                                                <br>
                                                    <?php $i++; ?>
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
                    @if($question->need)
                        <span class="text-danger">未上傳</span>
                    @else
                        @if($question->type <> "0")
                            <span class="text-warning">非必填</span>
                        @endif
                        @endif
                        @endif
                    </td>
                    @yield('input'.$question->id)
                </tr>
            @endforeach
        @endforeach
    @endforeach
</table>
