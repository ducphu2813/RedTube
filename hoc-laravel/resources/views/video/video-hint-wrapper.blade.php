<div class="side-video-list">
    {{-- Gọi all video-hint-item --}}
    @foreach($relatedVideos as $video)
        @if($video->display_mode == 1 && $video->active == 1 && $video->is_approved == 1)
            @component('video.video-hint-item', ['video' => $video])
            @endcomponent
        @endif
    @endforeach
{{--    --}}
{{--    @for($i = 0; $i < 10; $i++)--}}
{{--        @component('video.video-hint-item')--}}
{{--        @endcomponent--}}
{{--    @endfor--}}
</div>
