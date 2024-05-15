<link rel="stylesheet" href="{{ asset('css/newNoti.css') }}">
<div class="header-notify-list">
    {{-- Từng item video  --}}
    @for ($i = 0; $i < 3; $i++)
        @component('noti.noti-check')
        @endcomponent
        @component('noti.noti-comment')
        @endcomponent
        @component('noti.noti-premium-share')
        @endcomponent
    @endfor


</div>
