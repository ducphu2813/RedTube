<link rel="stylesheet" href="{{ asset('css/videoSearch.css') }}">
<div id="video-search-wrapper">
    @foreach($videos as $video)
        @component('video.video-in-main-item', ['video' => $video])
        @endcomponent
    @endforeach

</div>

{{-- Sờ cờ ríp cho playVideo tại này --}}
