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
                    <div class="centent-div">
                        {{ $question->order_by }} {{ $question->title }}<br>
                        (
                        @if($question->need=="1")
                            <span class="text-danger">必填</span>
                        @else
                            <span class="text-info">非必填</span>
                        @endif
                        {{ $type_items[$question->type] }}
                        @if($question->g_s=="1")
                            <span class="text-primary">{{ $g_s_items[$question->g_s] }}</span>
                        @elseif($question->g_s=="2")
                            <span class="text-danger">{{ $g_s_items[$question->g_s] }}</span>
                        @endif
                        )
                    </div>
                    @yield('upload'.$question->id)
                    <br>
                    <br>
                @endforeach
            </div>
            <br>
        @endforeach
    </div>
    <br>
@endforeach
