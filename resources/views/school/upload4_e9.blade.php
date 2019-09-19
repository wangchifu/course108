<table border="1">
    <tr>
        <td colspan="2">
            領域/科目
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $v }}年級
            </td>
        @endforeach
    </tr>
    <tr>
        <td rowspan="3">
            語文
        </td>
        <td width="100">
            國語文
        </td>
        @foreach($year9 as $v)
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
            本土語文/新住民語文
        </td>
        @foreach($year9 as $v)
            <td>
                @if(isset($area_file['dialects'][$v]))
                    <?php
                    $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['dialects'][$v];
                    ?>
                    <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'dialects']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                    <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'dialects']) }}" onclick="return confirm('確定刪除？')">
                        <i class="far fa-trash-alt text-info"></i>
                    </a>
                @else
                    @if($question->need=="1")
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'dialects']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @else
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'dialects']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                    @endif
                @endif
            </td>
        @endforeach
    </tr>
    <tr>
        <td>
            英語文
        </td>
        @foreach($year9 as $v)
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
        @foreach($year9 as $v)
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
        <td rowspan="3">
            生活
        </td>
        <td>
            社會
        </td>
        @foreach($year9 as $v)
            @if($v=="一" or $v=="二")
                <td rowspan="3">
                    @if(isset($area_file['life_curriculum'][$v]))
                        <?php
                        $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['life_curriculum'][$v];
                        ?>
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'life_curriculum']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                            <i class="fas fa-eye"></i> 檢視檔案
                        </a>
                        <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'life_curriculum']) }}" onclick="return confirm('確定刪除？')">
                            <i class="far fa-trash-alt text-info"></i>
                        </a>
                    @else
                        @if($question->need=="1")
                            <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'life_curriculum']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                        @else
                            <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'life_curriculum']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                        @endif
                    @endif
                </td>
            @else
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
            @endif
        @endforeach
    </tr>
    <tr>
        <td>
            自然與生活科技
        </td>
        @foreach($year9 as $v)
            @if($v=="一" or $v=="二")

            @else
                <td>
                    @if(isset($area_file['science_technology'][$v]))
                        <?php
                        $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$area_file['science_technology'][$v];
                        ?>
                        <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'science_technology']) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                        <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                            <i class="fas fa-eye"></i> 檢視檔案
                        </a>
                        <a href="{{ route('schools.delete4',['file_path'=>$file_path,'grade'=>$v,'subject'=>'science_technology']) }}" onclick="return confirm('確定刪除？')">
                            <i class="far fa-trash-alt text-info"></i>
                        </a>
                    @else
                        @if($question->need=="1")
                            <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'science_technology']) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
                        @else
                            <a href="javascript:open_upload('{{ route('schools.upload4',['select_year'=>$year->year,'question'=>$question->id,'grade'=>$v,'subject'=>'science_technology']) }}','新視窗')" class="badge badge-warning"><i class="fas fa-times-circle"></i> 未上傳</a>
                        @endif
                    @endif
                </td>
            @endif
        @endforeach
    </tr>
    <tr>
        <td>
            藝術與人文
        </td>
        @foreach($year9 as $v)
            @if($v=="一" or $v=="二")

            @else
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
            @endif
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            綜合活動
        </td>
        @foreach($year9 as $v)
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
            健康與體育
        </td>
        @foreach($year9 as $v)
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
