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
                <select name="mandarin_section[{{ $v }}]" required id="mandarin9{{ cht2num($v) }}" onchange="check_section('{{ cht2num($v) }}')">
                    <option>
                    </option>
                    @foreach($section9[$v]['mandarin'] as $section)
                        <option value="{{ $section }}">
                            {{ $section }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr>
        <td>
            英語文
        </td>
        @foreach($year9 as $v)
            <td>
                <select name="english_section[{{ $v }}]" required id="english9{{ cht2num($v) }}" onchange="check_section('{{ cht2num($v) }}')">
                    <option>
                    </option>
                    @foreach($section9[$v]['english'] as $section)
                        <option value="{{ $section }}">
                            {{ $section }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr bgcolor="#cccccc">
        <td colspan="2">
            小計
        </td>
        @foreach($year9 as $v)
            <td>
                <div id="language9{{ cht2num($v) }}"></div>
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            數學
        </td>
        @foreach($year9 as $v)
            <td>
                <select name="mathematics_section[{{ $v }}]" required id="mathematics9{{ cht2num($v) }}" onchange="check_section('{{ cht2num($v) }}')">
                    <option>
                    </option>
                    @foreach($section9[$v]['mathematics'] as $section)
                        <option value="{{ $section }}">
                            {{ $section }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            社會
        </td>
        @foreach($year9 as $v)
            <td>
                <select name="social_studies_section[{{ $v }}]" required id="social_studies9{{ cht2num($v) }}" onchange="check_section('{{ cht2num($v) }}')">
                    <option>
                    </option>
                    @foreach($section9[$v]['social_studies'] as $section)
                        <option value="{{ $section }}">
                            {{ $section }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            自然與生活科技
        </td>
        @foreach($year9 as $v)
            <td>
                <select name="science_technology_section[{{ $v }}]" required id="science_technology9{{ cht2num($v) }}" onchange="check_section('{{ cht2num($v) }}')">
                    <option>
                    </option>
                    @foreach($section9[$v]['science_technology'] as $section)
                        <option value="{{ $section }}">
                            {{ $section }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            藝術與人文
        </td>
        @foreach($year9 as $v)
            <td>
                <select name="arts_humanities_section[{{ $v }}]" required id="arts_humanities9{{ cht2num($v) }}" onchange="check_section('{{ cht2num($v) }}')">
                    <option>
                    </option>
                    @foreach($section9[$v]['arts_humanities'] as $section)
                        <option value="{{ $section }}">
                            {{ $section }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            綜合活動
        </td>
        @foreach($year9 as $v)
            <td>
                <select name="integrative_activities_section[{{ $v }}]" required id="integrative_activities9{{ cht2num($v) }}" onchange="check_section('{{ cht2num($v) }}')">
                    <option>
                    </option>
                    @foreach($section9[$v]['integrative_activities'] as $section)
                        <option value="{{ $section }}">
                            {{ $section }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr>
        <td colspan="2">
            健康與體育
        </td>
        @foreach($year9 as $v)
            <td>
                <select name="health_physical_section[{{ $v }}]" required id="health_physical9{{ cht2num($v) }}" onchange="check_section('{{ cht2num($v) }}')">
                    <option>
                    </option>
                    @foreach($section9[$v]['health_physical'] as $section)
                        <option value="{{ $section }}">
                            {{ $section }}
                        </option>
                    @endforeach
                </select>
            </td>
        @endforeach
    </tr>
    <tr bgcolor="#cccccc">
        <td colspan="2">
            領域總節數
        </td>
        @foreach($year9 as $v)
            <td>
                <div id="total_areas9{{ cht2num($v) }}"></div>
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
                <select name="alternative_section[{{ $v }}]" required id="alternative9{{ cht2num($v) }}" onchange="check_section('{{ cht2num($v) }}')">
                    <option>
                    </option>
                    @foreach($section9[$v]['alternative'] as $section)
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
        @foreach($year9 as $v)
            <td>
                <div id="total_sections9{{ cht2num($v) }}"></div>
            </td>
        @endforeach
    </tr>
</table>
<script>
    function check_section(grade){
        document.getElementById('language9'+grade).innerText=check(document.getElementById('mandarin9'+grade).value)+
            check(document.getElementById('english9'+grade).value);

        document.getElementById('total_areas9'+grade).innerText=check(document.getElementById('mandarin9'+grade).value)+
            check(document.getElementById('english9'+grade).value)+
            check(document.getElementById('mathematics9'+grade).value)+
            check(document.getElementById('social_studies9'+grade).value)+
            check(document.getElementById('science_technology9'+grade).value)+
            check(document.getElementById('arts_humanities9'+grade).value)+
            check(document.getElementById('integrative_activities9'+grade).value)+
            check(document.getElementById('health_physical9'+grade).value);

        document.getElementById('total_sections9'+grade).innerText=check(document.getElementById('total_areas9'+grade).innerText)+
            check(document.getElementById('alternative9'+grade).value);

    }

    function check( x ) {
        return x ? parseInt( x, 10 ) : 0;
    }

    function check_total(){
        var c=1;
        @if($year->j1=="9year")
        if(check(document.getElementById('language97').innerText) < 6 || check(document.getElementById('language97').innerText) > 8){
            alert('國中7年級語文領域小計節數應在6~8節之間');
            c=0;
            return false;
        }
        if(check(document.getElementById('total_areas97').innerText) != 28){
            alert('國中7年級領域總節數應為28節');
            c=0;
            return false;
        }
        @endif


            @if($year->j2=="9year")
        if(check(document.getElementById('language98').innerText) < 6 || check(document.getElementById('language98').innerText) > 8){
            alert('國中8年級語文領域小計節數應在6~8節之間');
            c=0;
            return false;
        }
        if(check(document.getElementById('total_areas98').innerText) != 28){
            alert('國中8年級領域總節數應為28節');
            c=0;
            return false;
        }
        @endif


            @if($year->j3=="9year")
        if(check(document.getElementById('language99').innerText) < 6 || check(document.getElementById('language99').innerText) > 9){
            alert('國中9年級語文領域小計節數應在6~9節之間');
            c=0;
            return false;
        }
        if(check(document.getElementById('total_areas99').innerText) != 30){
            alert('國中9年級領域總節數應為30節');
            c=0;
            return false;
        }
        @endif

        if(c==1) {
            document.getElementById('sections_store').submit();
        }
    }
</script>
