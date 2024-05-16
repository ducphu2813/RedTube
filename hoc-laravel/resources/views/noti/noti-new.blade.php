<link rel="stylesheet" href="{{ asset('css/newNoti.css') }}">
<div class="header-notify-list">
    {{-- Từng item video  --}}
    @foreach($notifications as $notification)
        @if($notification['type'] == 'share')
            @component('noti.noti-premium-share', ['notification' => $notification])
            @endcomponent
        @elseif($notification['type'] == 'video')
            @component('noti.noti-check', ['notification' => $notification])
            @endcomponent
        @endif
    @endforeach

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
