@extends('layouts.master',['bg_color'=>'bg-secondary'])

@section('title','學校專區 | ')

@foreach($questions as $question)
    @section('upload'.$question->id)
        @if($question->type=="1")
            <?php
                $upload = \App\Upload::where('question_id',$question->id)
                ->where('code',auth()->user()->code)
                ->first();
            ?>
            @if($upload)
                <?php
                $file_path = $year->year.'&&'.auth()->user()->code.'&&'.$question->id.'&&'.$upload->file;
                ?>
                <a href="javascript:open_upload('{{ route('schools.upload1',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-success"><i class="fas fa-check-circle"></i> 再上傳</a>
                <a href="{{ route('schools.open',$file_path) }}" class="badge badge-primary" target="_blank">
                    <i class="fas fa-eye"></i> 檢視上傳
                </a>
                <a href="{{ route('schools.delete1',$file_path) }}" onclick="return confirm('確定刪除？')">
                    <i class="far fa-trash-alt text-info"></i>
                </a>
            @else
                <a href="javascript:open_upload('{{ route('schools.upload1',['select_year'=>$year->year,'question'=>$question->id]) }}','新視窗')" class="badge badge-danger check_red"><i class="fas fa-times-circle"></i> 未上傳</a>
            @endif

        @endif
    @endsection
@endforeach

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <a href="#" class="btn btn-secondary btn-sm" onclick="history.back();"><i class="fas fa-backward"></i> 返回</a>
                </div>
                <div class="card-body">
                    <h1>{{ auth()->user()->school }} {{ $year->year }}學年度課程計畫</h1>
                    @include('school.questions')
                </div>
            </div>
        </div>
    </div>
    <script>
        function open_upload(url,name)
        {
            window.open(url,name,'statusbar=no,scrollbars=yes,status=yes,resizable=yes,width=900,height=200');
        }
    </script>
@endsection
