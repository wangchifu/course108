@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title','通知設定 | ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5>
                        <img src="{{ asset('images/email.svg') }}" height="24">
                        站內訊息
                    </h5>
                </div>
                <div class="card-body">
                    @include('layouts.form_errors')
                    <form action="{{ route('message_store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputPassword0">發出者：</label>
                            @if(auth()->user()->group_id > 2)
                                {{ $groups[auth()->user()->group_id] }}
                            @endif
                            @if(auth()->user()->group_id < 3)
                                {{ $schools[auth()->user()->code] }}
                            @endif
                            {{ auth()->user()->name }}
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword0">收訊者：</label>
                            @if($school_code)
                                {{ $schools[$school_code] }}
                                <input type="hidden" name="for_school_code" value="{{ $school_code }}">
                            @endif
                            @if($for_user)
                                @if($for_user->group_id < 3)
                                    {{ $schools[$for_user->code] }}
                                @endif
                                @if($for_user->group_id >2)
                                    {{ $groups[$for_user->group_id] }}
                                @endif
                                    {{ mb_substr($for_user->name,0,1) }}**
                                <input type="hidden" name="for_user_id" value="{{ $for_user->id }}">
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword0">訊息內容</label>
                            <textarea class="form-control" name="message" required></textarea>
                        </div>
                        <a href="#" class="btn btn-secondary btn-sm" onclick="history.back()">返回</a>
                        <button type="submit" class="btn btn-primary btn-sm" onclick="return confirm('確定嗎？')">送出</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function open_line()
        {
            var URL = 'https://notify-bot.line.me/oauth/authorize?';
            URL += 'response_type=code';
            URL += '&client_id=m5dxEjhHvMrmwmqSFXfuKY';
            URL += '&redirect_uri=https:\/\/course108.chc.edu.tw\/callback';
            URL += '&scope=notify';
            URL += '&state=NO_STATE';

            window.open(URL,name,'statusbar=no,scrollbars=yes,status=yes,resizable=yes,width=850,height=850');
        }
    </script>
@endsection
