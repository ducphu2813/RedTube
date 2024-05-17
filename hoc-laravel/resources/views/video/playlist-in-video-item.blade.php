<div id="body-playlist"
@if($videoInPL->video_id == $video->video_id)
    style="background: gainsboro"
    @endif
    >
    <div>
        <a href="http://127.0.0.1:8000/playVideo/{{ $videoInPL->video_id }}/{{ $videoPlaylist->playlist_id }}">
            <img src="{{ asset('storage/thumbnail/' . $videoInPL->thumbnail_path) }}"
                alt="">
        </a>
    </div>
    <div id="Video-title-playlist-playvideo">
        <a href="http://127.0.0.1:8000/playVideo/{{ $videoInPL->video_id }}/{{ $videoPlaylist->playlist_id }}"><span>{{ $videoInPL->title }}</span></a>
        <a href=""><span id="Channelname-playlist-playvideo">{{ $videoInPL->user->channel_name }}</span></a>
    </div>
</div>
