<link rel="stylesheet" href="{{ asset('css/videoInMain.css') }}">
<div class="video-category-filter">
    @if(($flag) == 2)
        <div class="video-category-container">
            @foreach ($listCate as $cate)
                <div class="video-category-item" id="{{ $cate->category_id }}">{{ $cate->name }}</div>
            @endforeach
        </div>
    @endif

    {{-- <div class="video-category-btn-list">
        <button class="video-category-btn-item btn btn-danger" id="cancel-cate">Hủy</button>
        <button class="video-category-btn-item btn btn-success" id="find-by-cate">Xem kết quả</button>
    </div> --}}

</div>
<div id="video-main-wrapper">
    @foreach($videos as $video)
        @component('video.video-in-main-item', ['video' => $video])
        @endcomponent
    @endforeach
</div>

{{-- Chổ này cho script control các video-item --}}
{{-- Hình như làm random video chổ này --}}
<script>

</script>
