<div id="box" class="video-renderer">
    {{--phần thumbnail--}}
    <div id="thumb-container" class="video-renderer">
        <a href="http://127.0.0.1:8000/playVideo/{{ $video->video_id }}">
            {{--hiện ảnh thumbnail--}}
            @if($video->thumbnail_path)
                <img id="thumb-image" class="video-renderer"
                     src="{{ asset('storage/thumbnail/' . $video->thumbnail_path) }}" alt="" width="400" height="224.44">
            @else
                <img id="thumb-image" class="video-renderer"
                     src="{{ asset('storage/thumbnail/default-thumbnail.jpg') }}" alt="" width="400" height="224.44">

            @endif
        </a>
    </div>
    <div id="text-wrapper" class="video-renderer">
        <div id="meta" class="video-renderer">
            <div id="title-wrapper" class="video-renderer">
                <h3 class="title">
                    <a id="video-title" class="video-renderer" href="http://127.0.0.1:8000/playVideo/{{ $video->video_id }}">{{ $video->title }}</a>
                </h3>
            </div>
            <div id="metadata" class="video-renderer">
                <span id="view_count_{{ $video->video_id }}"></span>
                <i class="fa-solid fa-circle"></i>
                <span id="date_count_{{ $video->video_id }}"></span>
            </div>
        </div>
        <div id="channel-info" class="video-renderer">
            <a id="channel-thumbnail" class="video-renderer" href="https://www.youtube.com/@TunaGamingvn">
                {{--icon avatar trong 1 component video--}}
                @if($video->user->picture_url)
                    <img id="img" class="video-renderer" src="{{ asset('storage/img/' . $video->user->picture_url) }}" alt="" width="24" height="24">
                @else
                    <img id="img" class="video-renderer" src="{{ asset('resources/img/defaulftPFP.jpg') }}" alt="" width="24" height="24">

                @endif
            </a>
            <div id="text-container" class="video-renderer">
                <a id="channel-name" class="video-renderer" href="https://www.youtube.com/@TunaGamingvn">{{ $video->user->channel_name }}</a>
            </div>
        </div>
    </div>

    <script>
        var views = formatViews({{ $video->view }});
        var time = formatTime('{{ $video->created_date }}');

        document.getElementById('view_count_{{ $video->video_id }}').textContent = views + ' lượt xem';
        document.getElementById('date_count_{{ $video->video_id }}').textContent = time;
    </script>

</div>
