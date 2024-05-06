<div class="side-video-list">
    {{-- Gọi all video-hint-item --}}
    @for($i = 0; $i < 10; $i++)
        @component('video.video-hint-item')
        @endcomponent
    @endfor
</div>
