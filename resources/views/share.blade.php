@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title','課程計畫分享')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h2>
                <img src="{{ asset('images/sharing-content.svg') }}" height="24">
                課程計畫分享
            </h2>
            <div class="card">
                <div class="card-header">
                    <h5>
                        <table>
                            <tr>
                                <td>
                                    <img src="{{ asset('images/check.svg') }}" height="24">
                                </td>
                                <td>
                                    選擇年度：
                                </td>
                                <td>
                                    {{ Form::open(['route'=>'share','method'=>'post']) }}
                                    {{ Form::select('year',$years,$select_year,['onchange'=>'submit()']) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        </table>
                    </h5>
                </div>
                <div class="card-body">
                    <h4><i class="fab fa-fort-awesome"></i> 彰化市</h4>
                    <a href="{{ url('share/'.$select_year.'/074308/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074308'] !!}彰化藝術高中(國中部)</a>
                    <a href="{{ url('share/'.$select_year.'/074505/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074505'] !!}陽明國中</a>
                    <a href="{{ url('share/'.$select_year.'/074506/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074506'] !!}彰安國中</a>
                    <a href="{{ url('share/'.$select_year.'/074507/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074507'] !!}彰德國中</a>
                    <a href="{{ url('share/'.$select_year.'/074538/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074538'] !!}彰興國中</a>
                    <a href="{{ url('share/'.$select_year.'/074540/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074540'] !!}彰泰國中</a>
                    <a href="{{ url('share/'.$select_year.'/074541/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074541'] !!}信義國中小(國中部)</a>
                    <a href="{{ url('share/'.$select_year.'/071311/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['071311'] !!}私立精誠高中(國中部)</a>
                    <a href="{{ url('share/'.$select_year.'/071318/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['071318'] !!}私立正德高中(國中部)</a>
                    <a href="{{ url('share/'.$select_year.'/074601/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074601'] !!}中山國小</a>
                    <a href="{{ url('share/'.$select_year.'/074602/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074602'] !!}民生國小</a>
                    <a href="{{ url('share/'.$select_year.'/074603/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074603'] !!}平和國小</a>
                    <a href="{{ url('share/'.$select_year.'/074604/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074604'] !!}南郭國小</a>
                    <a href="{{ url('share/'.$select_year.'/074605/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074605'] !!}南興國小</a>
                    <a href="{{ url('share/'.$select_year.'/074606/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074606'] !!}東芳國小</a>
                    <a href="{{ url('share/'.$select_year.'/074607/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074607'] !!}泰和國小</a>
                    <a href="{{ url('share/'.$select_year.'/074608/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074608'] !!}三民國小</a>
                    <a href="{{ url('share/'.$select_year.'/074609/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074609'] !!}聯興國小</a>
                    <a href="{{ url('share/'.$select_year.'/074610/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074610'] !!}大竹國小</a>
                    <a href="{{ url('share/'.$select_year.'/074611/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074611'] !!}國聖國小</a>
                    <a href="{{ url('share/'.$select_year.'/074612/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074612'] !!}快官國小</a>
                    <a href="{{ url('share/'.$select_year.'/074613/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074613'] !!}石牌國小</a>
                    <a href="{{ url('share/'.$select_year.'/074614/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074614'] !!}忠孝國小</a>
                    <a href="{{ url('share/'.$select_year.'/074774/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074774'] !!}信義國(中)小(國小部)</a>
                    <a href="{{ url('share/'.$select_year.'/074775/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074775'] !!}大成國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 芬園鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074509/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074509'] !!}芬園國中</a>
                    <a href="{{ url('share/'.$select_year.'/074615/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074615'] !!}芬園國小</a>
                    <a href="{{ url('share/'.$select_year.'/074616/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074616'] !!}富山國小</a>
                    <a href="{{ url('share/'.$select_year.'/074617/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074617'] !!}寶山國小</a>
                    <a href="{{ url('share/'.$select_year.'/074618/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074618'] !!}同安國小</a>
                    <a href="{{ url('share/'.$select_year.'/074619/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074619'] !!}文德國小</a>
                    <a href="{{ url('share/'.$select_year.'/074620/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074620'] !!}茄荖國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 花壇鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074526/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074526'] !!}花壇國中</a>
                    <a href="{{ url('share/'.$select_year.'/074621/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074621'] !!}花壇國小</a>
                    <a href="{{ url('share/'.$select_year.'/074622/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074622'] !!}文祥國小</a>
                    <a href="{{ url('share/'.$select_year.'/074623/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074623'] !!}華南國小</a>
                    <a href="{{ url('share/'.$select_year.'/074624/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074624'] !!}僑愛國小</a>
                    <a href="{{ url('share/'.$select_year.'/074625/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074625'] !!}三春國小</a>
                    <a href="{{ url('share/'.$select_year.'/074626/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074626'] !!}白沙國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 秀水鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074522/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074522'] !!}秀水國中</a>
                    <a href="{{ url('share/'.$select_year.'/074654/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074654'] !!}秀水國小</a>
                    <a href="{{ url('share/'.$select_year.'/074655/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074655'] !!}馬興國小</a>
                    <a href="{{ url('share/'.$select_year.'/074656/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074656'] !!}華龍國小</a>
                    <a href="{{ url('share/'.$select_year.'/074657/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074657'] !!}明正國小</a>
                    <a href="{{ url('share/'.$select_year.'/074658/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074658'] !!}陝西國小</a>
                    <a href="{{ url('share/'.$select_year.'/074659/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074659'] !!}育民國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 鹿港鎮</h4>
                    <a href="{{ url('share/'.$select_year.'/074503/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074503'] !!}鹿鳴國中</a>
                    <a href="{{ url('share/'.$select_year.'/074502/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074502'] !!}鹿港國中</a>
                    <a href="{{ url('share/'.$select_year.'/074542/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074542'] !!}鹿江國中(小)</a>
                    <a href="{{ url('share/'.$select_year.'/074639/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074639'] !!}鹿港國小</a>
                    <a href="{{ url('share/'.$select_year.'/074640/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074640'] !!}文開國小</a>
                    <a href="{{ url('share/'.$select_year.'/074641/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074641'] !!}洛津國小</a>
                    <a href="{{ url('share/'.$select_year.'/074642/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074642'] !!}海埔國小</a>
                    <a href="{{ url('share/'.$select_year.'/074643/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074643'] !!}新興國小</a>
                    <a href="{{ url('share/'.$select_year.'/074644/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074644'] !!}草港國小</a>
                    <a href="{{ url('share/'.$select_year.'/074645/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074645'] !!}頂番國小</a>
                    <a href="{{ url('share/'.$select_year.'/074646/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074646'] !!}東興國小</a>
                    <a href="{{ url('share/'.$select_year.'/074771/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074771'] !!}鹿東國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 福興鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074521/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074521'] !!}福興國中</a>
                    <a href="{{ url('share/'.$select_year.'/074647/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074647'] !!}管嶼國小</a>
                    <a href="{{ url('share/'.$select_year.'/074648/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074648'] !!}文昌國小</a>
                    <a href="{{ url('share/'.$select_year.'/074649/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074649'] !!}西勢國小</a>
                    <a href="{{ url('share/'.$select_year.'/074650/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074650'] !!}大興國小</a>
                    <a href="{{ url('share/'.$select_year.'/074651/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074651'] !!}永豐國小</a>
                    <a href="{{ url('share/'.$select_year.'/074652/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074652'] !!}日新國小</a>
                    <a href="{{ url('share/'.$select_year.'/074653/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074653'] !!}育新國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 線西鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074504/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074504'] !!}線西國中</a>
                    <a href="{{ url('share/'.$select_year.'/074633/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074633'] !!}線西國小</a>
                    <a href="{{ url('share/'.$select_year.'/074634/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074634'] !!}曉陽國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 和美鎮</h4>
                    <a href="{{ url('share/'.$select_year.'/074323/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074323'] !!}和美高中(國中部)</a>
                    <a href="{{ url('share/'.$select_year.'/074535/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074535'] !!}和群國中</a>
                    <a href="{{ url('share/'.$select_year.'/074627/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074627'] !!}和美國小</a>
                    <a href="{{ url('share/'.$select_year.'/074628/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074628'] !!}和東國小</a>
                    <a href="{{ url('share/'.$select_year.'/074629/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074629'] !!}大嘉國小</a>
                    <a href="{{ url('share/'.$select_year.'/074630/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074630'] !!}大榮國小</a>
                    <a href="{{ url('share/'.$select_year.'/074631/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074631'] !!}新庄國小</a>
                    <a href="{{ url('share/'.$select_year.'/074632/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074632'] !!}培英國小</a>
                    <a href="{{ url('share/'.$select_year.'/074769/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074769'] !!}和仁國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 伸港鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074524/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074524'] !!}伸港國中</a>
                    <a href="{{ url('share/'.$select_year.'/074635/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074635'] !!}新港國小</a>
                    <a href="{{ url('share/'.$select_year.'/074636/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074636'] !!}伸東國小</a>
                    <a href="{{ url('share/'.$select_year.'/074637/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074637'] !!}伸仁國小</a>
                    <a href="{{ url('share/'.$select_year.'/074638/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074638'] !!}大同國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 員林市</h4>
                    <a href="{{ url('share/'.$select_year.'/074510/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074510'] !!}員林國中</a>
                    <a href="{{ url('share/'.$select_year.'/074511/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074511'] !!}明倫國中</a>
                    <a href="{{ url('share/'.$select_year.'/074536/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074536'] !!}大同國中</a>
                    <a href="{{ url('share/'.$select_year.'/074680/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074680'] !!}員林國小</a>
                    <a href="{{ url('share/'.$select_year.'/074681/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074681'] !!}育英國小</a>
                    <a href="{{ url('share/'.$select_year.'/074682/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074682'] !!}靜修國小</a>
                    <a href="{{ url('share/'.$select_year.'/074683/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074683'] !!}僑信國小</a>
                    <a href="{{ url('share/'.$select_year.'/074684/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074684'] !!}員東國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074685/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074685'] !!}饒明國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074686/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074686'] !!}東山國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074687/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074687'] !!}青山國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074688/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074688'] !!}明湖國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 社頭鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074530/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074530'] !!}社頭國中</a>
                    <a href="{{ url('share/'.$select_year.'/074704/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074704'] !!}社頭國小</a>
                    <a href="{{ url('share/'.$select_year.'/074705/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074705'] !!}橋頭國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074706/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074706'] !!}朝興國小</a>
                    <a href="{{ url('share/'.$select_year.'/074707/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074707'] !!}清水國小</a>
                    <a href="{{ url('share/'.$select_year.'/074708/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074708'] !!}湳雅國小</a>
                    <a href="{{ url('share/'.$select_year.'/074772/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074772'] !!}舊社國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074773/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074773'] !!}崙雅國小 </a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 永靖鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074527/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074527'] !!}永靖國中</a>
                    <a href="{{ url('share/'.$select_year.'/074693/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074693'] !!}永靖國小</a>
                    <a href="{{ url('share/'.$select_year.'/074694/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074694'] !!}福德國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074695/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074695'] !!}永興國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074696/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074696'] !!}福興國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074697/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074697'] !!}德興國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 埔心鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074520/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074520'] !!}埔心國中 </a>
                    <a href="{{ url('share/'.$select_year.'/074673/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074673'] !!}埔心國小</a>
                    <a href="{{ url('share/'.$select_year.'/074674/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074674'] !!}太平國小</a>
                    <a href="{{ url('share/'.$select_year.'/074675/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074675'] !!}舊館國小</a>
                    <a href="{{ url('share/'.$select_year.'/074676/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074676'] !!}羅厝國小</a>
                    <a href="{{ url('share/'.$select_year.'/074677/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074677'] !!}鳳霞國小</a>
                    <a href="{{ url('share/'.$select_year.'/074678/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074678'] !!}梧鳳國小</a>
                    <a href="{{ url('share/'.$select_year.'/074679/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074679'] !!}明聖國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 溪湖鎮</h4>
                    <a href="{{ url('share/'.$select_year.'/074518/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074518'] !!}溪湖國中</a>
                    <a href="{{ url('share/'.$select_year.'/074339/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074339'] !!}成功高中(國中部)</a>
                    <a href="{{ url('share/'.$select_year.'/074660/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074660'] !!}溪湖國小</a>
                    <a href="{{ url('share/'.$select_year.'/074661/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074661'] !!}東溪國小</a>
                    <a href="{{ url('share/'.$select_year.'/074662/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074662'] !!}湖西國小</a>
                    <a href="{{ url('share/'.$select_year.'/074663/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074663'] !!}湖東國小</a>
                    <a href="{{ url('share/'.$select_year.'/074664/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074664'] !!}湖南國小</a>
                    <a href="{{ url('share/'.$select_year.'/074665/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074665'] !!}媽厝國小</a>
                    <a href="{{ url('share/'.$select_year.'/074777/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074777'] !!}湖北國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 大村鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074525/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074525'] !!}大村國中 </a>
                    <a href="{{ url('share/'.$select_year.'/074689/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074689'] !!}大村國小</a>
                    <a href="{{ url('share/'.$select_year.'/074690/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074690'] !!}大西國小</a>
                    <a href="{{ url('share/'.$select_year.'/074691/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074691'] !!}村上國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074692/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074692'] !!}村東國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 埔鹽鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074519/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074519'] !!}埔鹽國中</a>
                    <a href="{{ url('share/'.$select_year.'/074666/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074666'] !!}埔鹽國小</a>
                    <a href="{{ url('share/'.$select_year.'/074667/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074667'] !!}大園國小</a>
                    <a href="{{ url('share/'.$select_year.'/074668/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074668'] !!}南港國小</a>
                    <a href="{{ url('share/'.$select_year.'/074669/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074669'] !!}好修國小</a>
                    <a href="{{ url('share/'.$select_year.'/074670/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074670'] !!}永樂國小</a>
                    <a href="{{ url('share/'.$select_year.'/074671/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074671'] !!}新水國小</a>
                    <a href="{{ url('share/'.$select_year.'/074672/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074672'] !!}天盛國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 田中鎮</h4>
                    <a href="{{ url('share/'.$select_year.'/074328/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074328'] !!}田中高中(國中部) </a>
                    <a href="{{ url('share/'.$select_year.'/071317/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['071317'] !!}私立文興高中(國中部)</a>
                    <a href="{{ url('share/'.$select_year.'/074698/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074698'] !!}田中國小</a>
                    <a href="{{ url('share/'.$select_year.'/074699/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074699'] !!}三潭國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074700/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074700'] !!}大安國小</a>
                    <a href="{{ url('share/'.$select_year.'/074701/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074701'] !!}內安國小</a>
                    <a href="{{ url('share/'.$select_year.'/074702/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074702'] !!}東和國小</a>
                    <a href="{{ url('share/'.$select_year.'/074703/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074703'] !!}明禮國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074776/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074776'] !!}新民國小 </a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 北斗鎮</h4>
                    <a href="{{ url('share/'.$select_year.'/074501/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074501'] !!}北斗國中</a>
                    <a href="{{ url('share/'.$select_year.'/074712/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074712'] !!}北斗國小</a>
                    <a href="{{ url('share/'.$select_year.'/074713/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074713'] !!}萬來國小</a>
                    <a href="{{ url('share/'.$select_year.'/074714/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074714'] !!}螺青國小</a>
                    <a href="{{ url('share/'.$select_year.'/074715/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074715'] !!}大新國小</a>
                    <a href="{{ url('share/'.$select_year.'/074716/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074716'] !!}螺陽國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 田尾鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074531/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074531'] !!}田尾國中</a>
                    <a href="{{ url('share/'.$select_year.'/074717/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074717'] !!}田尾國小</a>
                    <a href="{{ url('share/'.$select_year.'/074718/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074718'] !!}南鎮國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074719/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074719'] !!}陸豐國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074720/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074720'] !!}仁豐國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 埤頭鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074534/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074534'] !!}埤頭國中</a>
                    <a href="{{ url('share/'.$select_year.'/074721/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074721'] !!}埤頭國小</a>
                    <a href="{{ url('share/'.$select_year.'/074722/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074722'] !!}合興國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074723/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074723'] !!}豐崙國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074724/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074724'] !!}芙朝國小</a>
                    <a href="{{ url('share/'.$select_year.'/074725/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074725'] !!}中和國小</a>
                    <a href="{{ url('share/'.$select_year.'/074726/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074726'] !!}大湖國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 溪州鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074532/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074532'] !!}溪州國中</a>
                    <a href="{{ url('share/'.$select_year.'/074533/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074533'] !!}溪陽國中</a>
                    <a href="{{ url('share/'.$select_year.'/074727/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074727'] !!}溪州國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074728/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074728'] !!}僑義國小</a>
                    <a href="{{ url('share/'.$select_year.'/074729/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074729'] !!}三條國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074730/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074730'] !!}水尾國小</a>
                    <a href="{{ url('share/'.$select_year.'/074731/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074731'] !!}潮洋國小</a>
                    <a href="{{ url('share/'.$select_year.'/074732/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074732'] !!}成功國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074733/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074733'] !!}圳寮國小</a>
                    <a href="{{ url('share/'.$select_year.'/074734/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074734'] !!}大莊國小</a>
                    <a href="{{ url('share/'.$select_year.'/074735/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074735'] !!}南州國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 竹塘鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074514/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074514'] !!}竹塘國中</a>
                    <a href="{{ url('share/'.$select_year.'/074753/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074753'] !!}竹塘國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074754/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074754'] !!}田頭國小</a>
                    <a href="{{ url('share/'.$select_year.'/074755/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074755'] !!}民靖國小</a>
                    <a href="{{ url('share/'.$select_year.'/074756/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074756'] !!}長安國小</a>
                    <a href="{{ url('share/'.$select_year.'/074757/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074757'] !!}土庫國小 </a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 二林鎮</h4>
                    <a href="{{ url('share/'.$select_year.'/074512/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074512'] !!}萬興國中</a>
                    <a href="{{ url('share/'.$select_year.'/074313/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074313'] !!}二林高中(國中部) </a>
                    <a href="{{ url('share/'.$select_year.'/074537/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074537'] !!}原斗國中</a>
                    <a href="{{ url('share/'.$select_year.'/074736/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074736'] !!}二林國小</a>
                    <a href="{{ url('share/'.$select_year.'/074737/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074737'] !!}興華國小</a>
                    <a href="{{ url('share/'.$select_year.'/074738/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074738'] !!}中正國小</a>
                    <a href="{{ url('share/'.$select_year.'/074739/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074739'] !!}育德國小</a>
                    <a href="{{ url('share/'.$select_year.'/074740/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074740'] !!}香田國小</a>
                    <a href="{{ url('share/'.$select_year.'/074741/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074741'] !!}廣興國小</a>
                    <a href="{{ url('share/'.$select_year.'/074742/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074742'] !!}萬興國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074743/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074743'] !!}新生國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074744/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074744'] !!}中興國小</a>
                    <a href="{{ url('share/'.$select_year.'/074745/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074745'] !!}原斗國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074746/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074746'] !!}萬合國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 大城鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074515/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074515'] !!}大城國中</a>
                    <a href="{{ url('share/'.$select_year.'/074747/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074747'] !!}大城國小</a>
                    <a href="{{ url('share/'.$select_year.'/074748/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074748'] !!}永光國小</a>
                    <a href="{{ url('share/'.$select_year.'/074749/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074749'] !!}西港國小</a>
                    <a href="{{ url('share/'.$select_year.'/074750/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074750'] !!}美豐國小</a>
                    <a href="{{ url('share/'.$select_year.'/074751/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074751'] !!}頂庄國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074752/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074752'] !!}潭墘國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 芳苑鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074517/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074517'] !!}芳苑國中</a>
                    <a href="{{ url('share/'.$select_year.'/074516/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074516'] !!}草湖國中 </a>
                    <a href="{{ url('share/'.$select_year.'/074543/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074543'] !!}民權國中</a>
                    <a href="{{ url('share/'.$select_year.'/074758/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074758'] !!}芳苑國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074759/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074759'] !!}後寮國小</a>
                    <a href="{{ url('share/'.$select_year.'/074760/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074760'] !!}民權國小</a>
                    <a href="{{ url('share/'.$select_year.'/074761/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074761'] !!}育華國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074762/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074762'] !!}草湖國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074763/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074763'] !!}建新國小</a>
                    <a href="{{ url('share/'.$select_year.'/074764/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074764'] !!}漢寶國小</a>
                    <a href="{{ url('share/'.$select_year.'/074765/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074765'] !!}王功國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074766/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074766'] !!}新寶國小</a>
                    <a href="{{ url('share/'.$select_year.'/074767/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074767'] !!}路上國小</a>
                    <hr>
                    <h4><i class="fab fa-fort-awesome"></i> 二水鄉</h4>
                    <a href="{{ url('share/'.$select_year.'/074529/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074529'] !!}二水國中 </a>
                    <a href="{{ url('share/'.$select_year.'/074709/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074709'] !!}二水國小 </a>
                    <a href="{{ url('share/'.$select_year.'/074710/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074710'] !!}復興國小</a>
                    <a href="{{ url('share/'.$select_year.'/074711/') }}" class="btn btn-light btn-sm" style="margin:3px" target="_blank">{!! $open['074711'] !!}源泉國小</a>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
