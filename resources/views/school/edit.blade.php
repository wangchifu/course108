@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title','學校專區 | ')

@foreach($questions as $question)
    @section('upload'.$question->id)
        <?php
        $upload = \App\Upload::where('question_id',$question->id)
            ->where('code',auth()->user()->code)
            ->first();
        ?>
        @if($question->type=="1")
            @if($upload)
                <?php
                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$upload->file;
                ?>
                <a href="javascript:open_upload('{{ route('schools.upload1',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                    <i class="fas fa-eye"></i> 檢視檔案
                </a>
                <a href="{{ route('schools.delete1',$file_path) }}" onclick="return confirm('確定刪除？')">
                    <i class="far fa-trash-alt text-info"></i>
                </a>
            @else
                @if($question->need=="1")
                    <a href="javascript:open_upload('{{ route('schools.upload1',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                @else
                    <a href="javascript:open_upload('{{ route('schools.upload1',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                @endif
            @endif
            <br>
        @endif

        @if($question->type=="2")
            @if($upload)
                <a href="javascript:open_upload('{{ route('schools.upload2',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                <?php
                $files = explode(',',$upload->file);
                $i=1;
                ?>
                <br>
                @foreach($files as $file)
                    <?php
                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$file;
                    ?>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> {{ substr($file,15) }}
                    </a>
                    <a href="{{ route('schools.delete2',$file_path) }}" onclick="return confirm('確定刪除 檔案{{ $i }} ？')">
                        <i class="far fa-trash-alt text-info"></i>
                    </a>
                    <br>
                    <?php $i++; ?>
                @endforeach
            @else
                @if($question->need=="1")
                    <a href="javascript:open_upload('{{ route('schools.upload2',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                @else
                    <a href="javascript:open_upload('{{ route('schools.upload2',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                @endif
            @endif
            <br>
        @endif

        @if($question->type=="3")
            @if($upload)
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
                <a href="{{ route('schools.delete3',$upload->id) }}" class="btn btn-info btn-sm" onclick="return confirm('確定重設？')"><i class="fas fa-trash-alt"></i> 清除重設</a>
                <a href="{{ route('schools.print',$upload->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-print"></i> 列印簽章檔案</a>
            @else
                @if($question->need=="1")
                    <a href="javascript:open_upload('{{ route('schools.upload3',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未填寫</a>
                @else
                    <a href="javascript:open_upload('{{ route('schools.upload3',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未填寫</a>
                @endif
            @endif
            <br>
        @endif

        @if($question->type=="4")
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
                                @include('school.upload4_e12')
                            @endif
                        </td>
                        <td>
                            　
                        </td>
                        <td>
                            @if(!empty($year9))
                                <strong>國小九年一貫課程</strong>
                                @include('school.upload4_e9')
                            @endif
                        </td>
                    @else(auth()->user()->group_id==2)
                        <td valign="top">
                            @if(!empty($year12))
                                <strong>國中十二年國教課程</strong>
                                @include('school.upload4_j12')
                            @endif
                        </td>
                        <td>
                            　
                        </td>
                        <td>
                            @if(!empty($year9))
                                <strong>國中九年一貫課程</strong>
                                @include('school.upload4_j9')
                            @endif
                        </td>
                    @endif
                </tr>
            </table>
            <br>
        @endif

        @if($question->type=="5")
            @if($upload)
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
                <a href="{{ route('schools.delete5',$upload->id) }}" class="btn btn-info btn-sm" onclick="return confirm('確定重設？')"><i class="fas fa-trash-alt"></i> 清除重設</a>
            @else
                @if($question->need=="1")
                    <a href="javascript:open_upload('{{ route('schools.upload5',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未填寫</a>
                @else
                    <a href="javascript:open_upload('{{ route('schools.upload5',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未填寫</a>
                @endif
            @endif
            <br>
        @endif

        @if($question->type=="6")
            <br>
            <?php
                 $f = ['1'=>'','2'=>'','3'=>'','4'=>'','5'=>'','6'=>'','7'=>'','8'=>'','9'=>''];
                 if($upload and $upload->file != null){
                     $check_f = unserialize($upload->file);
                     //填入
                     foreach($f as $k=>$v){
                         if(isset($check_f[$k])) $f[$k] = $check_f[$k];
                     }
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
                            單檔
                        </td>
                        <td>
                            @if($f[1])
                                <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'1']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <?php
                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[1];
                                ?>
                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                    <i class="fas fa-eye"></i> 檢視檔案
                                </a>
                                <a href="{{ route('schools.delete6',['file_path'=>$file_path,'stu_year'=>'1']) }}" onclick="return confirm('確定刪除 檔案？')">
                                    <i class="far fa-trash-alt text-info"></i>
                                </a>
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'1']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'1']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($f[2])
                                <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'2']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <?php
                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[2];
                                ?>
                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                    <i class="fas fa-eye"></i> 檢視檔案
                                </a>
                                <a href="{{ route('schools.delete6',['file_path'=>$file_path,'stu_year'=>'2']) }}" onclick="return confirm('確定刪除 檔案？')">
                                    <i class="far fa-trash-alt text-info"></i>
                                </a>
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'2']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'2']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($f[3])
                                <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'3']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <?php
                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[3];
                                ?>
                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                    <i class="fas fa-eye"></i> 檢視檔案
                                </a>
                                <a href="{{ route('schools.delete6',['file_path'=>$file_path,'stu_year'=>'3']) }}" onclick="return confirm('確定刪除 檔案？')">
                                    <i class="far fa-trash-alt text-info"></i>
                                </a>
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'3']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'3']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($f[4])
                                <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'4']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <?php
                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[4];
                                ?>
                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                    <i class="fas fa-eye"></i> 檢視檔案
                                </a>
                                <a href="{{ route('schools.delete6',['file_path'=>$file_path,'stu_year'=>'4']) }}" onclick="return confirm('確定刪除 檔案？')">
                                    <i class="far fa-trash-alt text-info"></i>
                                </a>
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'4']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'4']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($f[5])
                                <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'5']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <?php
                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[5];
                                ?>
                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                    <i class="fas fa-eye"></i> 檢視檔案
                                </a>
                                <a href="{{ route('schools.delete6',['file_path'=>$file_path,'stu_year'=>'5']) }}" onclick="return confirm('確定刪除 檔案？')">
                                    <i class="far fa-trash-alt text-info"></i>
                                </a>
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'5']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'5']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($f[6])
                                <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'6']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <?php
                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[6];
                                ?>
                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                    <i class="fas fa-eye"></i> 檢視檔案
                                </a>
                                <a href="{{ route('schools.delete6',['file_path'=>$file_path,'stu_year'=>'6']) }}" onclick="return confirm('確定刪除 檔案？')">
                                    <i class="far fa-trash-alt text-info"></i>
                                </a>
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'6']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'6']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
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
                                <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'7']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <?php
                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[7];
                                ?>
                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                    <i class="fas fa-eye"></i> 檢視檔案
                                </a>
                                <a href="{{ route('schools.delete6',['file_path'=>$file_path,'stu_year'=>'7']) }}" onclick="return confirm('確定刪除 檔案？')">
                                    <i class="far fa-trash-alt text-info"></i>
                                </a>
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'7']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'7']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($f[8])
                                <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'8']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <?php
                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[8];
                                ?>
                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                    <i class="fas fa-eye"></i> 檢視檔案
                                </a>
                                <a href="{{ route('schools.delete6',['file_path'=>$file_path,'stu_year'=>'8']) }}" onclick="return confirm('確定刪除 檔案？')">
                                    <i class="far fa-trash-alt text-info"></i>
                                </a>
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'8']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'8']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($f[9])
                                <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'9']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <?php
                                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$f[9];
                                ?>
                                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                    <i class="fas fa-eye"></i> 檢視檔案
                                </a>
                                <a href="{{ route('schools.delete6',['file_path'=>$file_path,'stu_year'=>'9']) }}" onclick="return confirm('確定刪除 檔案？')">
                                    <i class="far fa-trash-alt text-info"></i>
                                </a>
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'9']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload6',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'9']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳單檔</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                </table>
            @endif
        @endif

        @if($question->type=="7")
            <br>
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
                                <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'1']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <br>
                                @foreach($check_f[1] as $k=>$v)
                                    <?php
                                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                    ?>
                                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                        <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                    </a>
                                    <a href="{{ route('schools.delete7',['file_path'=>$file_path,'stu_year'=>'1']) }}" onclick="return confirm('確定刪除 檔案？')">
                                        <i class="far fa-trash-alt text-info"></i>
                                    </a>
                                    <br>
                                @endforeach
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'1']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'1']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @endif
                            @endif
                        </td>
                        <td valign="top">
                            @if(isset($check_f[2]))
                                <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'2']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <br>
                                @foreach($check_f[2] as $k=>$v)
                                    <?php
                                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                    ?>
                                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                        <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                    </a>
                                    <a href="{{ route('schools.delete7',['file_path'=>$file_path,'stu_year'=>'2']) }}" onclick="return confirm('確定刪除 檔案？')">
                                        <i class="far fa-trash-alt text-info"></i>
                                    </a>
                                    <br>
                                @endforeach
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'2']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'2']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @endif
                            @endif
                        </td>
                        <td valign="top">
                            @if(isset($check_f[3]))
                                <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'3']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <br>
                                @foreach($check_f[3] as $k=>$v)
                                    <?php
                                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                    ?>
                                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                        <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                    </a>
                                    <a href="{{ route('schools.delete7',['file_path'=>$file_path,'stu_year'=>'3']) }}" onclick="return confirm('確定刪除 檔案？')">
                                        <i class="far fa-trash-alt text-info"></i>
                                    </a>
                                    <br>
                                @endforeach
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'3']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'3']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @endif
                            @endif
                        </td>
                        <td valign="top">
                            @if(isset($check_f[4]))
                                <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'4']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <br>
                                @foreach($check_f[4] as $k=>$v)
                                    <?php
                                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                    ?>
                                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                        <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                    </a>
                                    <a href="{{ route('schools.delete7',['file_path'=>$file_path,'stu_year'=>'4']) }}" onclick="return confirm('確定刪除 檔案？')">
                                        <i class="far fa-trash-alt text-info"></i>
                                    </a>
                                    <br>
                                @endforeach
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'4']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'4']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @endif
                            @endif
                        </td>
                        <td valign="top">
                            @if(isset($check_f[5]))
                                <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'5']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <br>
                                @foreach($check_f[5] as $k=>$v)
                                    <?php
                                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                    ?>
                                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                        <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                    </a>
                                    <a href="{{ route('schools.delete7',['file_path'=>$file_path,'stu_year'=>'5']) }}" onclick="return confirm('確定刪除 檔案？')">
                                        <i class="far fa-trash-alt text-info"></i>
                                    </a>
                                    <br>
                                @endforeach
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'5']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'5']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @endif
                            @endif
                        </td>
                        <td valign="top">
                            @if(isset($check_f[6]))
                                <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'6']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <br>
                                @foreach($check_f[6] as $k=>$v)
                                    <?php
                                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                    ?>
                                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                        <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                    </a>
                                    <a href="{{ route('schools.delete7',['file_path'=>$file_path,'stu_year'=>'6']) }}" onclick="return confirm('確定刪除 檔案？')">
                                        <i class="far fa-trash-alt text-info"></i>
                                    </a>
                                    <br>
                                @endforeach
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'6']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'6']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
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
                            多檔
                        </td>
                        <td valign="top">
                            @if(isset($check_f[7]))
                                <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'7']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <br>
                                @foreach($check_f[7] as $k=>$v)
                                    <?php
                                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                    ?>
                                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                        <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                    </a>
                                    <a href="{{ route('schools.delete7',['file_path'=>$file_path,'stu_year'=>'7']) }}" onclick="return confirm('確定刪除 檔案？')">
                                        <i class="far fa-trash-alt text-info"></i>
                                    </a>
                                    <br>
                                @endforeach
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'7']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'7']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @endif
                            @endif
                        </td>
                        <td valign="top">
                            @if(isset($check_f[8]))
                                <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'8']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <br>
                                @foreach($check_f[8] as $k=>$v)
                                    <?php
                                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                    ?>
                                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                        <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                    </a>
                                    <a href="{{ route('schools.delete7',['file_path'=>$file_path,'stu_year'=>'8']) }}" onclick="return confirm('確定刪除 檔案？')">
                                        <i class="far fa-trash-alt text-info"></i>
                                    </a>
                                    <br>
                                @endforeach
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'8']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'8']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @endif
                            @endif
                        </td>
                        <td valign="top">
                            @if(isset($check_f[9]))
                                <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'9']) }}','新視窗')" class="badge badge-success"><i class="fas fa-times-circle"></i> 再上傳</a>
                                <br>
                                @foreach($check_f[9] as $k=>$v)
                                    <?php
                                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$v;
                                    ?>
                                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                                        <i class="fas fa-eye"></i> {{ substr($v,15) }}
                                    </a>
                                    <a href="{{ route('schools.delete7',['file_path'=>$file_path,'stu_year'=>'9']) }}" onclick="return confirm('確定刪除 檔案？')">
                                        <i class="far fa-trash-alt text-info"></i>
                                    </a>
                                    <br>
                                @endforeach
                            @else
                                @if($question->need=="1")
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'9']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @else
                                    <a href="javascript:open_upload('{{ route('schools.upload7',['select_year'=>$year->year,'question'=>$question->id,'stu_year'=>'9']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳多檔</a>
                                @endif
                            @endif
                        </td>
                    </tr>
                </table>
            @endif

        @endif

        @if($question->type=="8")
            @if($upload)
                <span class="text-primary"><i class="fas fa-calendar"></i> {{ $upload->file }}</span>
                <a href="{{ route('schools.delete8',$upload->id) }}" onclick="return confirm('確定重設 ？')">
                    <i class="far fa-trash-alt text-info"></i>
                </a>　
            @else
                @if($question->need=="1")
                    <a href="javascript:open_upload('{{ route('schools.upload8',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未填寫日期</a>
                @else
                    <a href="javascript:open_upload('{{ route('schools.upload8',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未填寫日期</a>
                @endif
            @endif
            <br>
        @endif
    @endsection
@endforeach

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('schools.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
                    <span class="text-danger">填完記得於底部送出審查後不再更改！才算正式送件！</span>
                </div>
                <div class="card-body">
                    <h1>{{ auth()->user()->school }} {{ $year->year }}學年度課程計畫</h1>
                    @include('school.questions')
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <?php
        $u =explode('/',$_SERVER['REQUEST_URI']);
        ?>
        <form action="{{ route('schools.submit') }}" method="post" onsubmit="return false" id="form_submit">
            @csrf
            <input type="hidden" name="select_year" value="{{ $year->year }}">
            <input type="hidden" name="action" value="{{ $u[2] }}">
            <br>
            <a href="{{ route('schools.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-backward"></i> 返回</a>
            <button type="submit" class="btn btn-danger btn-sm" onclick="check_red()">以上確認不再更改，送出審查！</button>
        </form>
    </div>
    <script>
        function open_upload(url,name)
        {
            window.open(url,name,'statusbar=no,scrollbars=yes,status=yes,resizable=yes,width=900,height=650');
        }

        function check_red(){
            var numItems = $('.check_red').length;
            if(confirm('送出後，無法再更改！您確定嗎?')){
                if(numItems>0){
                    alert('有必填題目未填！');
                    return false;
                }else{
                    document.getElementById('form_submit').submit();
                }
            }else{
                return false;
            }
        }

    </script>
@endsection
