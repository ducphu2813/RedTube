<!-- HTML code -->
<!-- HTML code -->

<div id="myModal" class="modal" onclick="closeModal(event)">
    <span class="close" onclick="event.stopPropagation(); closeModal(event)">&times;</span>

    <div class="modal-content">
        <h4>Lưu video vào</h4>

        @if( !session('loggedInUser'))
            Bạn cần <a href="#">đăng nhập</a> để thêm video vào danh sách phát
        @elseif( $playlists->count() == 0 )
            Chưa có danh sách phát nào
            <div id="new-playlist">
                <i class="fa-solid fa-plus"></i>
                <span>Tạo danh sách phát mới</span>
            </div>
        @else
            <div id="playlist-name">
                @foreach($playlists as $playlist)
                    <div class="playlist-save">
                        <input type="checkbox"
                               class="playlist-checkbox"
                               data-playlist-id="{{ $playlist->playlist_id }}"
                               data-video-id="{{ $video->video_id }}"
                            {{ $playlist->isVideoInPlaylist($video->video_id) ? 'checked' : '' }}
                        >
                        <a href="">{{ $playlist->name }}</a>
                    </div>
                @endforeach
            </div>
                <div id="new-playlist">
                    <i class="fa-solid fa-plus"></i>
                    <span>Tạo danh sách phát mới</span>
                </div>
        @endif

    </div>
</div>


<script>
    // JavaScript code
    function openModal() {
        document.getElementById("myModal").style.display = "block";
    }

    function closeModal(event) {
        var modal = document.getElementById("myModal");
        var modalContent = document.querySelector(".modal-content");

        // Kiểm tra xem sự kiện click có xảy ra trên phần tử modal-content không
        if (!modalContent.contains(event.target)) {
            modal.style.display = "none";
        }
    }

    //xử lý checkbox của playlist
    $(document).ready(function () {

        $('.playlist-checkbox').click(function () {
            var playlistId = $(this).data('playlist-id');
            var videoId = $(this).data('video-id');
            var isChecked = $(this).is(':checked');
            $.ajax({
                url: "{{ route('playlist.update') }}",
                method: "POST",
                data: {
                    playlist_id: playlistId,
                    video_id: videoId,
                    is_checked: isChecked,
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log(response);
                }
            });
        });

    });
</script>
