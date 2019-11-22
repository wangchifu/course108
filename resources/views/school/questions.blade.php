<?php
 $u =explode('/',$_SERVER['REQUEST_URI']);
?>
@foreach($parts as $part)
    <div class="row title-div">
        <div class="col-12">
            <h3>
                {{ $part_order_by[$part->order_by] }}、{{ $part->title }}
            </h3>
        </div>
    </div>
    <div class="row custom-div">
        @foreach($part->topics as $topic)
            <div class="col-2">
                <div class="section-div">
                    {{ $topic->order_by }}.{{ $topic->title }}
                </div>
            </div>
            <div class="col-10">
                @foreach($topic->questions as $question)
                    @if(($u[2] == "edit" and $question->g_s==1) or ($u[2] == "edit2" and $question->g_s==2))
                        <?php
                            $show_wrong1 = null;
                            $show_wrong2 = null;
                            $show_wrong3 = null;
                            $bg= null;
                            if($course->first_result1=="back" and $course->first_result2==null){
                                $first1 = \App\FirstSuggest1::where('question_id',$question->id)
                                    ->where('pass','0')
                                    ->first();
                                if($first1){
                                    $show_wrong1 = "<i class='fas fa-times-circle text-danger'></i>";
                                    $bg = "background-color:#FF8888";
                                }
                            }
                            if($course->first_result2=="back" and $course->first_result3==null){
                                $first2 = \App\FirstSuggest2::where('question_id',$question->id)
                                    ->where('pass','0')
                                    ->first();
                                if($first2){
                                    $show_wrong2 = "<i class='fas fa-times-circle text-danger'></i>";
                                    $bg = "background-color:#FF8888";
                                }
                            }
                            if($course->first_result3=="back"){
                                $first3 = \App\FirstSuggest3::where('question_id',$question->id)
                                    ->where('pass','0')
                                    ->first();
                                if($first3){
                                    $show_wrong3 = "<i class='fas fa-times-circle text-danger'></i>";
                                    $bg = "background-color:#FF8888";
                                }
                            }
                        ?>
                        <div class="centent-div" style="{{ $bg }}">
                            {!! $show_wrong1 !!}{!! $show_wrong2 !!}{!! $show_wrong3 !!}{{ $question->order_by }} {{ $question->title }}<br>
                        </div>
                        @yield('upload'.$question->id)
                        @if($question->type!="0")
                            <br>
                        @endif
                    @endif
                @endforeach
            </div>
            <br>
        @endforeach
    </div>
    <br>
@endforeach
