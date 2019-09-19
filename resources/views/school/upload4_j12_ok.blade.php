<table border="1">
    <tr>
        <td colspan="2">
            領域/科目
        </td>
        @foreach($year12 as $v)
            <td>
                {{ $v }}年級
            </td>
        @endforeach
    </tr>
    <tr>
        <td rowspan="2">
            語文
        </td>
        <td width="100">
            國語文
        </td>
        @foreach($year12 as $v)
            <td>
                @if(isset($area_file['mandarin'][$v]))
                    <?php
                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['mandarin'][$v];
                    ?>
                    <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'mandarin']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                    <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'mandarin']) }}" onclick="return confirm('確定刪除？')">
                        <i class="far fa-trash-alt text-info"></i>
                    </a>
                @else
                    @if($question->need=="1")
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'mandarin']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @else
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'mandarin']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @endif
                @endif
            </td>
        @endforeach
    </tr>
    <tr>
        <td>
            英語文
        </td>
        @foreach($year12 as $v)
            <td>
                @if(isset($area_file['english'][$v]))
                    <?php
                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['english'][$v];
                    ?>
                    <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'english']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                    <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'english']) }}" onclick="return confirm('確定刪除？')">
                        <i class="far fa-trash-alt text-info"></i>
                    </a>
                @else
                    @if($question->need=="1")
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'english']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @else
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'english']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @endif
                @endif
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            數學
        </td>
        @foreach($year12 as $v)
            <td>
                @if(isset($area_file['mathematics'][$v]))
                    <?php
                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['mathematics'][$v];
                    ?>
                    <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'mathematics']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                    <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'mathematics']) }}" onclick="return confirm('確定刪除？')">
                        <i class="far fa-trash-alt text-info"></i>
                    </a>
                @else
                    @if($question->need=="1")
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'mathematics']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @else
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'mathematics']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @endif
                @endif
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            社會
        </td>
        @foreach($year12 as $v)
            <td>
                @if(isset($area_file['social_studies'][$v]))
                    <?php
                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['social_studies'][$v];
                    ?>
                    <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'social_studies']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                    <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'social_studies']) }}" onclick="return confirm('確定刪除？')">
                        <i class="far fa-trash-alt text-info"></i>
                    </a>
                @else
                    @if($question->need=="1")
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'social_studies']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @else
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'social_studies']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @endif
                @endif
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            自然科學
        </td>
        @foreach($year12 as $v)
            <td>
                @if(isset($area_file['science'][$v]))
                    <?php
                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['science'][$v];
                    ?>
                    <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'science']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                    <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'science']) }}" onclick="return confirm('確定刪除？')">
                        <i class="far fa-trash-alt text-info"></i>
                    </a>
                @else
                    @if($question->need=="1")
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'science']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @else
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'science']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @endif
                @endif
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            藝術
        </td>
        @foreach($year12 as $v)
            <td>
                @if(isset($area_file['arts_humanities'][$v]))
                    <?php
                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['arts_humanities'][$v];
                    ?>
                    <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'arts_humanities']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                    <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'arts_humanities']) }}" onclick="return confirm('確定刪除？')">
                        <i class="far fa-trash-alt text-info"></i>
                    </a>
                @else
                    @if($question->need=="1")
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'arts_humanities']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @else
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'arts_humanities']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @endif
                @endif
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            綜合活動
        </td>
        @foreach($year12 as $v)
            <td>
                @if(isset($area_file['integrative_activities'][$v]))
                    <?php
                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['integrative_activities'][$v];
                    ?>
                    <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'integrative_activities']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                    <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'integrative_activities']) }}" onclick="return confirm('確定刪除？')">
                        <i class="far fa-trash-alt text-info"></i>
                    </a>
                @else
                    @if($question->need=="1")
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'integrative_activities']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @else
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'integrative_activities']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @endif
                @endif
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            科技
        </td>
        @foreach($year12 as $v)
            <td>
                @if(isset($area_file['technology'][$v]))
                    <?php
                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['technology'][$v];
                    ?>
                    <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'technology']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                    <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'technology']) }}" onclick="return confirm('確定刪除？')">
                        <i class="far fa-trash-alt text-info"></i>
                    </a>
                @else
                    @if($question->need=="1")
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'technology']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @else
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'technology']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @endif
                @endif
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            健康與體育
        </td>
        @foreach($year12 as $v)
            <td>
                @if(isset($area_file['health_physical'][$v]))
                    <?php
                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['health_physical'][$v];
                    ?>
                    <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'health_physical']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                    <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'health_physical']) }}" onclick="return confirm('確定刪除？')">
                        <i class="far fa-trash-alt text-info"></i>
                    </a>
                @else
                    @if($question->need=="1")
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'health_physical']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @else
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'health_physical']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @endif
                @endif
            </td>
        @endforeach
    </tr>
</table>
