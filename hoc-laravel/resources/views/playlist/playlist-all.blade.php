<link rel="stylesheet" href="{{ asset('css/playlistAll.css') }}">
<h3 style="margin: 20px; color:#fff">
    Danh sách phát
</h3>

<div class="all-playlist-container">
    {{-- Cái này là nhiều danh sách phát --}}
    @for ($i = 0; $i < 10; $i++)
        <div class="all-playlist-item">
            <div class="all-playlist-img">
                <img src="{{ asset('resources/img/ocean.jpg') }}" alt="">
            </div>
            <div class="all-playlist-info">
                <div class="all-playlist-name">
                    Playlist name
                </div>
                <div class="all-playlist-btn">
                    <i class="fa-solid fa-xmark"></i>
                </div>
            </div>
        </div>
    @endfor
</div>

{{-- Sờ cờ ríp xóa danh sách phát ở này --}}
<script>
    $(document).ready(function() {
        // Cái này script xóa danh sách phát
        $('.all-playlist-btn').click(function() {
            console.log('Xóa danh sách phát');
        });

        // Cái này script chuyển trang khi click vào danh sách phát
        $('.all-playlist-img, .all-playlist-name').click(function() {
            console.log('Chuyển trang thành phát danh sách');
        });
    });
</script>
