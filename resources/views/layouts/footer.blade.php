<footer class="py-3 {{ $bg_color }}" id="footer">
    <div class="container">
        <p class="m-0 text-center text-white">
            Copyright &copy;  2019 彰化縣教育處學管科 <br>
            <small>程式設計：ET Wang</small>
        </p>
    </div>
</footer>

@auth
    <script>
        $(document).ready(function () {
            var yetVisited = localStorage['visited'];

            var mycount = $("#ModalLong").data('mycount');
            if (mycount > 0) {
                if (!yetVisited) {
                    $("#ModalLong").modal('show');
                    //localStorage['visited'] = "yes";
                }
            }
        });
    </script>

    <!-- Modal -->
    <?php
        $messages = \App\Message::where(function($q){
            $q->where('for_school_code','<>',null)
                ->Where('for_school_code',auth()->user()->code);
                })->orWhere('from_user_id',auth()->user()->id)
            ->orWhere('for_user_id',auth()->user()->id)
            ->get();
        $i = 0;

        foreach($messages as $message){
            if($message->has_read == null){
                if($message->for_school_code==auth()->user()->code){
                    if($message->for_school_code <> null){
                        $i++;
                    }
                }
                if($message->for_user_id == auth()->user()->id){
                    $i++;
                }
            }
        }

    ?>
    <div class="modal fade" id="ModalLong" tabindex="-1" role="dialog" aria-labelledby="ModalLongTitle"
         aria-hidden="true" data-mycount="{{ $i }}">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalLongTitle">請注意：</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    你有 {{ $i }} 則未讀通知！<br>
                    請至「<a href="{{ route('notify') }}">通知訊息</a>」查看。
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                </div>
            </div>
        </div>
    </div>
@endauth
