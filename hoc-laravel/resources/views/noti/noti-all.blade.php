<link rel="stylesheet" href="{{ asset('css/noti.css') }}">
<link href="https://fonts.cdnfonts.com/css/youtube-sans" rel="stylesheet">
                
<h1 style="text-align: center; margin: 20px;">Tất cả thông báo</h1>
<div class="noti-all-wrapper">
    {{-- Chổ này load 1 loạt thông báo, tùy theo loại mà dùng đúng file --}}
    {{-- Phân biệt component bằng cờ qua json --}}
    
    @component('noti.noti-check')
    @endcomponent

    @component('noti.noti-premium-share')
    @endcomponent

    @component('noti.noti-comment')
    @endcomponent
    
    @component('noti.noti-comment')
    @endcomponent

</div>