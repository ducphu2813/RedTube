<div id="video-time-wrapper">
    <div id="video-time-title">
        <h2>{{ $date }}</h2>
    </div>

    @foreach($histories as $history)
        <div id="box" class="video-renderer">
            <div id="thumb-container" class="video-renderer">
                <a href="http://127.0.0.1:8000/playVideo/{{ $history->video->video_id }}">

                    {{-- phần thumbnail--}}
                    @if($history->video->thumbnail_path)
                        <img id="thumb-image" class="video-renderer"
                             src="{{ asset('storage/thumbnail/' . $history->video->thumbnail_path) }}" alt="" width="439" height="246.33">
                    @else
                        <img id="thumb-image" class="video-renderer"
                             src="{{ asset('storage/thumbnail/default-thumbnail.jpg') }}" alt="" width="439" height="246.33">

                    @endif
                </a>
            </div>
            <div id="text-wrapper" class="video-renderer">
                <div id="meta" class="video-renderer">
                    <div id="title-wrapper" class="video-renderer">
                        <h3 class="title">
                            <a id="video-title" class="video-renderer"
                               href="http://127.0.0.1:8000/playVideo/{{ $history->video->video_id }}">{{ $history->video->title }}</a>
                        </h3>
                    </div>
                    <div id="metadata" class="video-renderer">
                        <span id="his_view_{{ $history->history_id }}">{{ $history->video->view }}</span>
                        <i class="fa-solid fa-circle"></i>
                        <span id="his_date_{{ $history->history_id }}">{{ $history->video->created_date }}</span>
                    </div>
                </div>
                <div id="channel-info" class="video-renderer">
                    <a id="channel-thumbnail" class="video-renderer" href="https://www.youtube.com/@TunaGamingvn">

                        {{--phần icon avatar--}}
                        @if($history->video->user->picture_url)
                            <img id="img" class="video-renderer" src="{{ asset('storage/img/' . $history->video->user->picture_url) }}" alt="" width="24" height="24">
                        @else
                            <img id="img" class="video-renderer" src="{{ asset('resources/img/defaulftPFP.jpg') }}" alt="" width="24" height="24">

                        @endif

                    </a>
                    <div id="text-container" class="video-renderer">

                        {{-- tên kênh--}}
                        <a id="channel-name" class="video-renderer"
                           href="https://www.youtube.com/@TunaGamingvn">{{ $history->video->user->channel_name }}</a>
                    </div>
                </div>
            </div>

            <script>
                var views = formatViews({{ $history->video->view }});
                var time = formatTime('{{ $history->video->created_date }}');

                document.getElementById('his_view_{{ $history->history_id }}').textContent = views + ' lượt xem';
                document.getElementById('his_date_{{ $history->history_id }}').textContent = time;
            </script>
        </div>
    @endforeach

{{--    @for ($i = 0; $i < 3; $i++)--}}
{{--        <div id="box" class="video-renderer">--}}
{{--            <div id="thumb-container" class="video-renderer">--}}
{{--                <a href="https://www.youtube.com/watch?v=YNaAyu2cOV4">--}}
{{--                    <img id="thumb-image" class="video-renderer"--}}
{{--                        src="https://i.ytimg.com/vi/YNaAyu2cOV4/hq720.jpg?sqp=-oaymwEcCNAFEJQDSFXyq4qpAw4IARUAAIhCGAFwAcABBg==&rs=AOn4CLCg_kUWgKXOIHp8oq0tsEAq7gouTg"--}}
{{--                        alt="">--}}
{{--                </a>--}}
{{--            </div>--}}
{{--            <div id="text-wrapper" class="video-renderer">--}}
{{--                <div id="meta" class="video-renderer">--}}
{{--                    <div id="title-wrapper" class="video-renderer">--}}
{{--                        <h3 class="title">--}}
{{--                            <a id="video-title" class="video-renderer"--}}
{{--                                href="https://www.youtube.com/watch?v=YNaAyu2cOV4">CHÚ--}}
{{--                                TÔI DƯƠNG TÍNH VỚI MAI THÚY | HÔN NHÂN CÓ GÌ VUI #5</a>--}}
{{--                        </h3>--}}
{{--                    </div>--}}
{{--                    <div id="metadata" class="video-renderer">--}}
{{--                        <span>100 lượt xem</span>--}}
{{--                        <i class="fa-solid fa-circle"></i>--}}
{{--                        <span>2 tuần trước</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div id="channel-info" class="video-renderer">--}}
{{--                    <a id="channel-thumbnail" class="video-renderer" href="https://www.youtube.com/@TunaGamingvn">--}}
{{--                        <img id="img" class="video-renderer"--}}
{{--                            src="https://yt3.googleusercontent.com/ytc/AIdro_lCzI--zWxJHl_sZunYFi5uIN_n6okiNy7lZ6FLidxG_0M=s176-c-k-c0x00ffffff-no-rj"--}}
{{--                            alt="">--}}
{{--                    </a>--}}
{{--                    <div id="text-container" class="video-renderer">--}}
{{--                        <a id="channel-name" class="video-renderer"--}}
{{--                            href="https://www.youtube.com/@TunaGamingvn">Monsieur--}}
{{--                            Tuna</a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    @endfor--}}
    <hr>
</div>
