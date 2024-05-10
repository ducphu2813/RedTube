<div id="body-playlist">
    <div>
        <a href="http://127.0.0.1:8000/playVideo/{{ $videoInPL->video_id }}/{{ $videoPlaylist->playlist_id }}">
            <img src="https://i.ytimg.com/an_webp/2Q8s5c474bg/mqdefault_6s.webp?du=3000&sqp=CLj1wrEG&rs=AOn4CLB_qPtJ60gaxUTWwLTtra1ZQK91zQ"
                alt="">
        </a>
    </div>
    <div id="Video-title-playlist-playvideo">
        <a href="http://127.0.0.1:8000/playVideo/{{ $videoInPL->video_id }}"><span>{{ $videoInPL->title }}</span></a>
        <a href=""><span id="Channelname-playlist-playvideo">{{ $videoInPL->user->channel_name }}</span></a>
    </div>
</div>
