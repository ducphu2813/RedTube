<link rel="stylesheet" href="{{ asset('css/videoSearch.css') }}">
{{-- Cái này duyệt thời gian nữa nha --}}
{{-- Mỗi thời gian thì gom thành 1 wrapper --}}
<div id="video-list-wrapper">
    <h1 style="color: #fff; margin: 20px">Nhật ký xem</h1>
    @for ($i = 0; $i < 3; $i++)
        @component('history.video-history-item')
        @endcomponent
    @endfor
</div>
