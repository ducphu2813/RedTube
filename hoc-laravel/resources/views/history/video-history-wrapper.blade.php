<link rel="stylesheet" href="{{ asset('css/videoSearch.css') }}">
{{-- Cái này duyệt thời gian nữa nha --}}
{{-- Mỗi thời gian thì gom thành 1 wrapper --}}
<div id="video-list-wrapper">
    <h1 style="color: #fff; margin: 20px">Nhật ký xem</h1>

    @foreach($groupedHistories as $date => $histories)
        @component('history.video-history-item', ['date' => $date, 'histories' => $histories])
        @endcomponent
    @endforeach

</div>
