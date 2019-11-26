@extends('layouts.master',['bg_color'=>'bg-dark'])

@section('title','通知設定 | ')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>
                        <img src="{{ asset('images/bell.svg') }}" height="24">
                        通知設定
                    </h5>
                </div>
                <div class="card-body">
                    @include('layouts.form_errors')
                    <form action="{{ route('email_store') }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group">
                            <label for="exampleInputPassword0">即時個人信箱通知</label>
                            <input type="email" class="form-control" name="email" value="{{ auth()->user()->email }}" placeholder="請填個人常用信箱">
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="return confirm('確定嗎？')">送出</button>
                    </form>
                    <hr>
                    @if(auth()->user()->access_token)
                        已訂閱 <i class="fab fa-line text-success"></i> LINE 通知 <a href="{{ route('cancel') }}" onclick="return confirm('確定取消訂閱？')"><i class="fas fa-times-circle text-danger"></i></a>
                    @else
                        <button type="button" onclick="open_line()"><i class="fab fa-line text-success"></i> 訂閱LINE通知</button>
                    @endif
                    <hr>
                    <table class="table table-striped">
                        <thead class="thead-light">
                        <tr>
                            <th width="8%">標示</th>
                            <th width="20%">時間</th>
                            <th width="20%">寄件者</th>
                            <th width="20%">收件者</th>
                            <th>內容</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($messages as $message)
                            <tr>
                                <td>
                                    @if($message->has_read)
                                        @if($message->from_user_id != auth()->user()->id)
                                            已讀
                                        @endif
                                    @else
                                        @if($message->from_user_id != auth()->user()->id)
                                        <a href="{{ route('notify_read',$message->id) }}" class="badge badge-danger" onclick="return confirm('標示已讀？')">未讀</a>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    {{ $message->created_at }}
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td>
                                                @if($message->from_user->group_id > 2)
                                                    {{ $groups[$message->from_user->group_id] }}
                                                @endif
                                                @if($message->from_user->group_id < 3)

                                                    {{ $schools[$message->from_user->code] }}
                                                @endif
                                                @if($message->from_user_id == auth()->user()->id)
                                                    {{ $message->from_user->name }}
                                                @else
                                                    {{ mb_substr($message->from_user->name,0,1) }}**
                                                @endif
                                            </td>
                                            <td>
                                                @if($message->from_user_id != auth()->user()->id)
                                                    <form action="{{ route('message') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="for_user_id" value="{{ $message->from_user_id }}">
                                                        <button><i class="fas fa-comment-dots text-primary"></i></button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td>
                                    @if($message->for_user_id)
                                        @if($message->for_user->group_id > 2)
                                            {{ $groups[$message->for_user->group_id] }}
                                        @endif
                                        @if($message->for_user->group_id < 3)

                                            {{ $schools[$message->for_user->code] }}
                                        @endif
                                        @if($message->for_user_id == auth()->user()->id)
                                            {{ $message->for_user->name }}
                                        @else
                                            {{ mb_substr($message->for_user->name,0,1) }}**
                                        @endif
                                    @else
                                        {{ $schools[$message->for_school_code] }}
                                    @endif
                                </td>
                                <td>
                                    @if($message->from_user_id == auth()->user()->id)
                                        <span class="text-secondary">[寄件備份] {{ $message->message }}</span>
                                    @else
                                        <span class="text-primary">{{ $message->message }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
