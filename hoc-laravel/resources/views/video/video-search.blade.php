<link rel="stylesheet" href="{{ asset('css/videoSearch.css') }}">
<div id="video-search-wrapper">
    @for ($i = 0; $i < 10; $i++)
        @component('video.video-in-main-item')
        @endcomponent
    @endfor
</div>