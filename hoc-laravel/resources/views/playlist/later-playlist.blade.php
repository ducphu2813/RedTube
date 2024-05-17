<!-- Danh sách phát -->
<link rel="stylesheet" href="{{ asset('css/later-playlist.css') }}">
<!-- khung thông tin playlist -->
<div id="panel-wrapper">
    <div id="panel">
        <div id="thumb-container" class="playlist-thumbnail">
            <a id="" href="">
                <img id="thumb-img" class="playlist-thumbnail"
                    src="https://i.ytimg.com/vi/YNaAyu2cOV4/hq720.jpg?sqp=-oaymwEcCNAFEJQDSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLCg_kUWgKXOIHp8oq0tsEAq7gouTg"
                    alt="">
            </a>
        </div>
        <div id="text-wrapper" class="text-wrapper-playlist">
            <div id="title-wrapper" class="title-wrapper-playlist">
                <h3 id="title" class="title-playlist">Video lưu vào xem sau</h3>
            </div>
            <div id="self-profile">
                <h4>
                    <a id="profile-name" href="">My profile</a>
                </h4>
            </div>
            <div id="status-video">
                <span>So luong video</span>
                <i class="fa-solid fa-circle"></i>
                <span>so luot xem</span>
                <i class="fa-solid fa-circle"></i>
                <span>thoi gian cap nhat</span>
            </div>
            <div>
                <i class="fa-solid fa-download"></i>
            </div>
            <div id="function-wrapper">
                <div id="play-all-wrapper">
                    <a class="play-all" href="">
                        <div>
                            <i class="fa-solid fa-play"></i>
                        </div>
                        <div>
                            <span class="text">Phát tất cả</span>
                        </div>
                    </a>
                </div>
                <div id="shuffle-wrapper">
                    <a id="shuffle" href="">
                        <div>
                            <i class="fa-solid fa-shuffle"></i>
                        </div>
                        <div>
                            <span class="text">Trộn bài</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- video playlist -->
<div id="playlist" class="video-playlist">
    {{-- Data đặt ở đây --}}

    @foreach($watchLaterVideo as $video)
        <div class="box-container">
            <div id="index-container">
                <span id="index">1</span>
            </div>
            <div id="box" class="video-playlist">
                <div id="thumb-container" class="video-playlist">
                    <a href="https://www.youtube.com/watch?v=YNaAyu2cOV4">
                        <img id="thumb-image" class="video-playlist"
                             src="https://i.ytimg.com/vi/YNaAyu2cOV4/hq720.jpg?sqp=-oaymwEcCNAFEJQDSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLCg_kUWgKXOIHp8oq0tsEAq7gouTg"
                             alt="">
                    </a>
                </div>
                <div id="text-wrapper" class="video-playlist">
                    <div id="meta" class="video-playlist">
                        <div id="title-wrapper" class="video-playlist">
                            <h3 class="title">
                                <a id="video-title" class="video-playlist"
                                   href="https://www.youtube.com/watch?v=YNaAyu2cOV4">{{ $video->title }}</a>
                            </h3>
                        </div>
                        <div id="metadata" class="video-playlist">
                            <a id="status-video" class="video-playlist"
                               href="https://www.youtube.com/watch?v=YNaAyu2cOV4">
                                <span>100 lượt xem</span>
                                <i class="fa-solid fa-circle"></i>
                                <span>2 tuần trước</span>
                            </a>
                        </div>
                    </div>
                    <div id="channel-info" class="video-playlist">
                        <div id="text-container" class="video-playlist">
                            <a id="channel-name" class="video-playlist"
                               href="https://www.youtube.com/@TunaGamingvn">Monsieur Tuna</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>

{{-- Gáng mà script --}}
<script>
    $(document).ready(function() {
        // Script hết trong này nha
    });
</script>
