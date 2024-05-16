{{-- Modal này để dùng cho add và edit --}}
<!-- Dùng modal.css ### -->
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
<div id="modal__playlistDetails" class="modal__popup">
    <div class="modal__overlay">
        @if($flag == 'edit')
            <form action="" class="modal-form" method="post" enctype="multipart/form-data">
                <div class="modal__header">
                    <div class="modal__title">Tạo danh sách phát</div>
                </div>

                <div class="modal__body">
                    <div class="form-group" style="display: none">
                        <label for="playlist_id">Id</label>
                        <input type="text" id="playlist_id" name="playlist_id" value="{{ $playlist->playlist_id }}">
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">Tên</label>
                        <input type="text" id="name" value='{{ $playlist->name }}'>
                    </div>
                </div>

                <div class="modal__footer">
                    <div class="option">
                        <button class="close--btn" id="close--btn">Hủy</button>
                        <button class="save--btn" id="save--btn">Lưu</button>
                    </div>
                </div>
            </form>
        @else
            <form action="" class="modal-form" method="post" enctype="multipart/form-data">
                <div class="modal__header">
                    <div class="modal__title">Tạo danh sách phát</div>
                </div>

                <div class="modal__body">
                    <div class="form-group">
                        <label for="" class="form-label">Tên</label>
                        <input type="text" id="name">
                    </div>
                </div>

                <div class="modal__footer">
                    <div class="option">
                        <button class="close--btn" id="close--btn">Hủy</button>
                        <button class="save--btn" id="save--btn">Lưu</button>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
{{-- 
<div class="modal-pl">
    <div class="modal-info-wrapper">
        <div id="modal-info-header">
            <h4>Tạo danh sách phát mới</h4>
        </div>

        <div id="modal-info-content">
            <div class="modal-info-content--item">
                <label for="modal-name">Tên danh sách phát</label>
                <input type="text" name="modal-name" id="modal-name" placeholder="Thêm tiêu đề">
            </div>
        </div>

        <div id="modal-info-btn">
            <button class="modal-btn" id="modal-info-btn--cancel">Hủy</button>
            <button class="modal-btn" id="modal-info-btn--create">Tạo</button>
        </div>
    </div>
</div> --}}

<script>
    $('#modal__playlistDetails').ready(function() {
        $('#close--btn').on('click', function(event) {
            $('#modal').empty();
            event.preventDefault();
        });
    
        $('#save--btn').on('click', function(event) {
            if ('{{ $flag }}' == 'edit') {
                $.ajax({
                    url: '{{ route('api.playlists.edit') }}',
                    type: 'PUT',
                    data: {
                        playlist_id: $('#playlist_id').val(),
                        name: $('#name').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'html',
                    success: function(data) {
                        $('#modal').empty();
                        loadPage({{ $currentPage }}, '{{ route('studio.contents.playlists') }}', {{ $itemPerPage }})
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching content:', error);
                        console.log("...Otori")
                    }
                });
                event.preventDefault();
            }
            else {
                $.ajax({
                    url: '{{ route('api.playlists.create') }}',
                    type: 'POST',
                    data: {
                        name: $('#name').val(),
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'html',
                    success: function(data) {
                        $('#modal').empty();
                        loadPage({{ $currentPage }}, '{{ route('studio.contents.playlists') }}', {{ $itemPerPage }})
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching content:', error);
                        console.log("hallo im Emu...")
                    }
                });
                event.preventDefault();
            }
        });
    });
</script>