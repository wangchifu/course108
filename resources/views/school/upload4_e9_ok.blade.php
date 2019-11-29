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
            本土語文/新住民語文
        </td>
        @foreach($year9 as $v)
            <td>
                @if(isset($area_file['dialects'][$v]))
                    <?php
                    $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['dialects'][$v];
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
        @foreach($year9 as $v)
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
        @foreach($year9 as $v)
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
                        $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['life_curriculum'][$v];
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
            @else
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
                        $file_path = $year->year.'&&'.$school_code.'&&'.$question->id.'&&'.$area_file['science_technology'][$v];
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
            健康與體育
        </td>
        @foreach($year9 as $v)
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
