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
                        <div class="centent-div">
                            {{ $question->order_by }} {{ $question->title }}<br>
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
