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
                    $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['mandarin'][$v];
                    ?>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                @else
                    @if($question->need=="1")
                        <span class="text-danger">未上傳</span>
                    @else
                        <span class="text-warning">未上傳</span>
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
                    $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['english'][$v];
                    ?>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                @else
                    @if($question->need=="1")
                        <span class="text-danger">未上傳</span>
                    @else
                        <span class="text-warning">未上傳</span>
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
                    $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['mathematics'][$v];
                    ?>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                @else
                    @if($question->need=="1")
                        <span class="text-danger">未上傳</span>
                    @else
                        <span class="text-warning">未上傳</span>
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
                    $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['social_studies'][$v];
                    ?>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                @else
                    @if($question->need=="1")
                        <span class="text-danger">未上傳</span>
                    @else
                        <span class="text-warning">未上傳</span>
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
                    $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['science'][$v];
                    ?>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                @else
                    @if($question->need=="1")
                        <span class="text-danger">未上傳</span>
                    @else
                        <span class="text-warning">未上傳</span>
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
                    $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['arts_humanities'][$v];
                    ?>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                @else
                    @if($question->need=="1")
                        <span class="text-danger">未上傳</span>
                    @else
                        <span class="text-warning">未上傳</span>
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
                    $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['integrative_activities'][$v];
                    ?>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                @else
                    @if($question->need=="1")
                        <span class="text-danger">未上傳</span>
                    @else
                        <span class="text-warning">未上傳</span>
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
                    $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['technology'][$v];
                    ?>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                @else
                    @if($question->need=="1")
                        <span class="text-danger">未上傳</span>
                    @else
                        <span class="text-warning">未上傳</span>
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
                    $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['health_physical'][$v];
                    ?>
                    <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                        <i class="fas fa-eye"></i> 檢視檔案
                    </a>
                @else
                    @if($question->need=="1")
                        <span class="text-danger">未上傳</span>
                    @else
                        <span class="text-warning">未上傳</span>
                    @endif
                @endif
            </td>
        @endforeach
    </tr>
</table>
