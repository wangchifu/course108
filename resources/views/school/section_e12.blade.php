<table border="1">
    <tr>
        <td colspan="4">
            領域/科目
        </td>
        @foreach($year12 as $v)
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
        <td rowspan="3">
            語文
        </td>
        <td width="100">
            國語文
        </td>
        @foreach($year12 as $v)
            <td>
                <input type="text" size="3" name="mandarin_section[{{ $v }}]" value="{{ $section12[$v]['mandarin'] }}" readonly="readonly" id="mandarin{{ cht2num($v) }}">
            </td>
        @endforeach
    </tr>
    <tr>
        <td>
            本土語文/新住民語文
        </td>
        @foreach($year12 as $v)
            <td>
                <input type="text" size="3" name="dialects_section[{{ $v }}]" value="{{ $section12[$v]['dialects'] }}" readonly="readonly" id="dialects{{ cht2num($v) }}">
            </td>
        @endforeach
    </tr>
    <tr>
        <td>
            英語文
        </td>
        @foreach($year12 as $v)
            <td>
                @if($v=="一" or $v=="二")
                    -
                @else
                    <input type="text" size="3" name="english_section[{{ $v }}]" value="{{ $section12[$v]['english'] }}" readonly="readonly" id="english{{ cht2num($v) }}">
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
                <input type="text" size="3" name="mathematics_section[{{ $v }}]" value="{{ $section12[$v]['mathematics'] }}" readonly="readonly" id="mathematics{{ cht2num($v) }}">
            </td>
        @endforeach
    </tr>
    <tr>
        <td rowspan="4">
            生活
        </td>
        <td>
            社會
        </td>
        @foreach($year12 as $v)
            @if($v=="一" or $v=="二")
                <td rowspan="4">
                    <input type="text" size="3" name="life_curriculum_section[{{ $v }}]" value="{{ $section12[$v]['life_curriculum'] }}" readonly="readonly" id="life_curriculum{{ cht2num($v) }}">
                </td>
            @else
                <td>
                    <input type="text" size="3" name="social_studies_section[{{ $v }}]" value="{{ $section12[$v]['social_studies'] }}" readonly="readonly" id="social_studies{{ cht2num($v) }}">
                </td>
            @endif
        @endforeach
    </tr>
    <tr>
        <td>
            自然科學
        </td>
        @foreach($year12 as $v)
            @if($v=="一" or $v=="二")

            @else
                <td>
                    <input type="text" size="3" name="science_section[{{ $v }}]" value="{{ $section12[$v]['science'] }}" readonly="readonly" id="science{{ cht2num($v) }}">
                </td>
            @endif
        @endforeach
    </tr>
    <tr>
        <td>
            藝術
        </td>
        @foreach($year12 as $v)
            @if($v=="一" or $v=="二")

            @else
                <td>
                    <input type="text" size="3" name="arts_humanities_section[{{ $v }}]" value="{{ $section12[$v]['arts_humanities'] }}" readonly="readonly" id="arts_humanities{{ cht2num($v) }}">
                </td>
            @endif
        @endforeach
    </tr>
    <tr>
        <td>
            綜合活動
        </td>
        @foreach($year12 as $v)
            @if($v=="一" or $v=="二")

            @else
                <td>
                    <input type="text" size="3" name="integrative_activities_section[{{ $v }}]" value="{{ $section12[$v]['integrative_activities'] }}" readonly="readonly" id="integrative_activities{{ cht2num($v) }}">
                </td>
            @endif
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            健康與體育
        </td>
        @foreach($year12 as $v)
            <td>
                <input type="text" size="3" name="health_physical_section[{{ $v }}]" value="{{ $section12[$v]['health_physical'] }}" readonly="readonly" id="health_physical{{ cht2num($v) }}">
            </td>
        @endforeach
    </tr>
    <tr bgcolor="#cccccc">
        <td colspan="2">
            領域總節數
        </td>
        @foreach($year12 as $v)
            <td>
                <div id="total_areas{{ cht2num($v) }}"></div>
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
        @foreach($year12 as $v)
            <td>
                <select name="alternative_section[{{ $v }}]" required  onchange="total_areas('total_areas{{ cht2num($v) }}',{{ cht2num($v) }})" id="alternative{{ cht2num($v) }}">
                    <option>
                    </option>
                    @foreach($section12[$v]['alternative'] as $section)
                        <option value="{{ $section }}">
                            {{ $section }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr bgcolor="#cccccc">
        <td colspan="4">
            總節數
        </td>
        @foreach($year12 as $v)
            <td>
                <div id="total_sections{{ cht2num($v) }}"></div>
            </td>
        @endforeach
    </tr>
</table>
<script>
    function total_areas(id,grade){
        if(parseInt(grade)>=3){
            document.getElementById(id).innerText=parseInt(document.getElementById('mandarin'+grade).value)+
                parseInt(document.getElementById('dialects'+grade).value)+
                parseInt(document.getElementById('english'+grade).value)+
                parseInt(document.getElementById('mathematics'+grade).value)+
                parseInt(document.getElementById('social_studies'+grade).value)+
                parseInt(document.getElementById('science'+grade).value)+
                parseInt(document.getElementById('arts_humanities'+grade).value)+
                parseInt(document.getElementById('integrative_activities'+grade).value)+
                parseInt(document.getElementById('health_physical'+grade).value);
        }else{
            document.getElementById(id).innerText=parseInt(document.getElementById('mandarin'+grade).value)+
                parseInt(document.getElementById('dialects'+grade).value)+
                parseInt(document.getElementById('mathematics'+grade).value)+
                parseInt(document.getElementById('life_curriculum'+grade).value)+
                parseInt(document.getElementById('health_physical'+grade).value);
        }
        total_sections(grade);

    }
    function total_sections(grade){
        document.getElementById('total_sections'+grade).innerText=parseInt(document.getElementById('total_areas'+grade).innerText)+
            parseInt(document.getElementById('alternative'+grade).value);
    }
</script>
