<link rel="stylesheet" href="{{ asset('css/videoInMain.css') }}">
<div id="video-main-wrapper">
    @foreach($videos as $video)
        @component('video.video-in-main-item', ['video' => $video])
        @endcomponent
    @endforeach
</div>

{{-- Chổ này cho script control các video-item --}}
{{-- Hình như làm random video chổ này --}}
<script>
</script>
