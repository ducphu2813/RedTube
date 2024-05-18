<link rel="stylesheet" href="{{ asset('css/videoInMain.css') }}">
<div class="video-category-filter">
    @if(($flag) == 2)
        <div class="video-category-container">
            @foreach ($listCate as $cate)
                <div class="video-category-item" id="{{ $cate->category_id }}">{{ $cate->name }}</div>
            @endforeach
        </div>
    @endif

</div>
<div id="video-main-wrapper">
    @foreach($videos as $video)
        @component('video.video-in-main-item', ['video' => $video])
        @endcomponent
    @endforeach
</div>

<script>

</script>
