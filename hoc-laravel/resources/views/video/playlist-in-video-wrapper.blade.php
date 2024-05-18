<div id="container-playlist-playvideo">
    <div id="header-playlist">
        <div id="header-title">
            <h4>{{ $videoPlaylist->name }}</h4>
            <i class="fa-solid fa-angle-up close"></i>
        </div>
        <div>
            <span>{{$videoPlaylist->user->channel_name}}</span>
            <span></span>
            <span></span> <!-- 1/20 là số video trong playlist -->
        </div>
        <div>
        </div>
    </div>

    {{-- Chổ này gọi all playlist-in-video-item --}}
    <span class="show-list">

        @foreach($videosInPlayList as $videoInPL)
            @component('video.playlist-in-video-item', ['videoInPL' => $videoInPL, 'videoPlaylist' => $videoPlaylist, 'video' => $video])
            @endcomponent
        @endforeach

    </span>

</div>

<script>
    // Script sổ cái danh sách phát
    document.querySelector("#header-title .close").addEventListener("click", function() {
        var scrollBtn = document.querySelector("#header-title .close");
        if(scrollBtn.classList.contains("fa-angle-up")) {
            scrollBtn.classList.remove("fa-angle-up");
            scrollBtn.classList.add("fa-angle-down");
        } else {
            scrollBtn.classList.remove("fa-angle-down");
            scrollBtn.classList.add("fa-angle-up");
        }
        document.querySelector(".show-list").classList.toggle("hidden-list");
        document.getElementById("container-playlist-playvideo").classList.toggle("scroll-list");

    });
</script>
