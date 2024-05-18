<link rel="stylesheet" href="{{ asset('css/playlistAll.css') }}">
<h3 style="margin: 20px; color:#fff">
    {{-- Danh sách phát --}}
</h3>

<div class="all-playlist-container">
{{-- Cái này là nhiều danh sách phát --}}

    @foreach($userPlaylist as $playlist)
        <div class="all-playlist-item" id="{{ $playlist->playlist_id }}"
             data-first-video-id="{{ optional($playlist->getFirstVideo())->video_id }}"
             data-has-videos="{{ $playlist->hasVideos() ? 'true' : 'false' }}"
        >
            <div class="all-playlist-img">
                <img src="{{ asset('resources/img/ocean.jpg') }}" alt="">
            </div>
            <div class="all-playlist-info">
                <div class="all-playlist-name" id="{{ $playlist->playlist_id }}">
                    {{ $playlist->name }}
                </div>
                <div class="all-playlist-btn">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
        </div>
    @endforeach

</div>

{{-- script xóa danh sách phát ở đậy --}}
<script>

    $(document).ready(function() {
        // Cái này script xóa danh sách phát
        $('.all-playlist-btn').click(function() {
            console.log('Xóa danh sách phát');
        });

        // Cái này script chuyển trang khi click vào danh sách phát
        //thêm sự kiện cho cả img và name

        $('.all-playlist-img, .all-playlist-name').click(function() {

            var hasVideosBool = $(this).closest('.all-playlist-item').data('has-videos');
            console.log('hasVideos:', hasVideosBool);

            var hasVideos = String(hasVideosBool) === 'true';
            console.log(hasVideos);
            if (!hasVideos) {
                alert('Danh sách phát không có video nào');
                return;
            }

            var firstVideoId = $(this).closest('.all-playlist-item').data('first-video-id');
            console.log(firstVideoId);
            if (!firstVideoId) {
                alert('Không tìm thấy video đầu tiên trong danh sách phát.');
                return;
            }
            var playlistId = $(this).closest('.all-playlist-item').attr('id');
            console.log(playlistId);
            window.location.href = '/playVideo/' + firstVideoId + '/' + playlistId;
        });
    });
</script>
