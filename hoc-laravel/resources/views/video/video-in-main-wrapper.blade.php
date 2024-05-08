<link rel="stylesheet" href="{{ asset('css/videoInMain.css') }}">
<div id="video-main-wrapper">
    @for ($i = 0; $i < 10; $i++)
        @component('video.video-in-main-item')
        @endcomponent
    @endfor
</div>

{{-- Chổ này cho script control các video-item --}}
{{-- Hình như làm random video chổ này --}}
<script>

</script>