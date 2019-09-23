<table border="1">
    <tr>
        <td colspan="4">
            領域/科目
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $v }}年級
            </td>
        @endforeach
    </tr>
    <tr>
        <td rowspan="10" width="10">
            部定課程
        </td>
        <td rowspan="10" width="10">
            領域學習課程
        </td>
        <td rowspan="2">
            語文
        </td>
        <td width="100">
            國語文
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $area_section['mandarin_section'][$v] }}
                <?php
                if(!isset($total_language[$v])) $total_language[$v] =0;
                if(!isset($total[$v])) $total[$v] =0;
                $total_language[$v] += $area_section['mandarin_section'][$v];
                $total[$v] += $area_section['mandarin_section'][$v];
                ?>
            </td>
        @endforeach
    </tr>
    <tr>
        <td>
            英語文
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $area_section['english_section'][$v] }}
                <?php
                $total_language[$v] += $area_section['english_section'][$v];
                $total[$v] += $area_section['english_section'][$v];
                ?>
            </td>
        @endforeach
    </tr>
    <tr bgcolor="#cccccc">
        <td colspan="2">
            小計
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $total_language[$v] }}
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            數學
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $area_section['mathematics_section'][$v] }}
                <?php
                $total[$v] += $area_section['mathematics_section'][$v];
                ?>
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            社會
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $area_section['social_studies_section'][$v] }}
                <?php
                $total[$v] += $area_section['social_studies_section'][$v];
                ?>
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            自然與生活科技
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $area_section['science_technology_section'][$v] }}
                <?php
                $total[$v] += $area_section['science_technology_section'][$v];
                ?>
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            藝術與人文
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $area_section['arts_humanities_section'][$v] }}
                <?php
                $total[$v] += $area_section['arts_humanities_section'][$v];
                ?>
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            綜合活動
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $area_section['integrative_activities_section'][$v] }}
                <?php
                $total[$v] += $area_section['integrative_activities_section'][$v];
                ?>
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            健康與體育
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $area_section['health_physical_section'][$v] }}
                <?php
                $total[$v] += $area_section['health_physical_section'][$v];
                ?>
            </td>
        @endforeach
    </tr>
    <tr bgcolor="#cccccc">
        <td colspan="2">
            領域總節數
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $total[$v] }}
            </td>
        @endforeach
    </tr>
    <tr>
        <td>
            校訂課程
        </td>
        <td colspan="3">
            彈性學習課程
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $area_section['alternative_section'][$v] }}
            </td>
        @endforeach
    </tr>
    <tr bgcolor="#cccccc">
        <td colspan="4">
            總節數
        </td>
        @foreach($year9 as $v)
            <td>
                {{ $total[$v]+$area_section['alternative_section'][$v] }}
            </td>
        @endforeach
    </tr>
</table>
