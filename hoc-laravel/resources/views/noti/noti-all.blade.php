<link rel="stylesheet" href="{{ asset('css/noti.css') }}">
<link href="https://fonts.cdnfonts.com/css/youtube-sans" rel="stylesheet">

<h1 style="font-size: 24px;font-weight: bold;margin: 32px 0px 32px 24px;">Tất cả thông báo</h1>
<div class="noti-all-wrapper">
    {{-- Chổ này load 1 loạt thông báo, tùy theo loại mà dùng đúng file --}}
    {{-- Phân biệt component bằng cờ qua json --}}
    {{-- Tao biet roi may deo can phai chi oke--}}

    @foreach($notifications as $notification)
        @if($notification['type'] == 'share')
            @component('noti.noti-premium-share', ['notification' => $notification])
            @endcomponent
        @elseif($notification['type'] == 'video')
            @component('noti.noti-check', ['notification' => $notification])
            @endcomponent
        @endif
    @endforeach

{{--    @component('noti.noti-check')--}}
{{--    @endcomponent--}}

{{--    @component('noti.noti-premium-share')--}}
{{--    @endcomponent--}}

{{--    @component('noti.noti-comment')--}}
{{--    @endcomponent--}}

{{--    @component('noti.noti-comment')--}}
{{--    @endcomponent--}}


    <script>
        //phần event cho các nút chấp nhận và từ chối

        $(document).ready(function() {

            $('.handle-btn').click(function() {

                let noti_id = $(this).attr('noti_id');
                let action = $(this).attr('action');

                $.ajax({
                    url: '{{ route('clients.handleShare') }}',
                    type: 'POST',
                    data: {
                        noti_id: noti_id,
                        action: action,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        console.log(data);
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            });

        });
    </script>
</div>
