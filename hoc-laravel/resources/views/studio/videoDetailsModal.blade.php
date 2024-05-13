<link rel="stylesheet" href="{{ asset('css/studio/videoDetailsModal.css') }}">

<div id="modal__videoDetails" class="modal__popup">
    @if($flag == 'edit')
        <div class="modal__overlay">
            <form action="" class="modal-form" method="post" enctype="multipart/form-data">
                <div class="form-section">
                    <div class="form-top">Chi tiết video</div>
                </div>

                <div class="form-bottom">
                    <div class="form-left">
                        <div class="form-group" style="display: none">
                            <label for="video_id">Id</label>
                            <input type="text" id="video_id" name="video_id" value="{{ $video->video_id }}">
                        </div>

                        <div class="form-group">
                            <label for="video">Đăng tải video</label>
                            <input type="file" id="video_path" name="video" accept="video/*" value="{{ $video->video_path }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="title">Tiêu đề (required)</label>
                            <textarea name="title" id="title" rows="2">{{ $video->title }}</textarea>
                        </div>
            
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea name="description" id="description" rows="18">{{ $video->description }}</textarea>
                        </div>
                    </div>
            
                    <div class="form-right">
                        <div class="form-group">
                            <label for="thumbnail">Đăng tải ảnh bìa</label>
                            <input type="file" id="thumbnail_path" name="thumbnail" accept="image/*" value="{{ $video->thumbnail_path }}">
            
                            <div class="review__thumbnail">
                                <img src="" alt="" id="thumbnail--review" class="thumbnail--img">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category">Thể loại</label>
                            <input type="text" id="category" disabled value="Thể loại A">
                        </div>
            
                        <div class="form-group">
                            <label for="privacy">Chế độ</label>
                            <select id="display_mode" name="privacy">
                                <option value="1" {{ $video->display_mode == 1 ? 'selected' : '' }}>Công khai</option>
                                <option value="0" {{ $video->display_mode != 1 ? 'selected' : '' }}>Riêng tư</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="option">
                                <button class="close--btn" id="close--btn">Hủy</button>
                                <button class="save--btn" id="save--btn" type="button">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @else
        <div class="modal__overlay">
            <form action="" class="modal-form" enctype="multipart/form-data" method="">
                <div class="form-section">
                    <div class="form-top">Tạo video</div>
                </div>

                <div class="form-bottom">
                    <div class="form-left">
                        <div class="form-group">
                            <label for="video">Đăng tải video</label>
                            <input type="file" id="video_path" name="video" accept="video/*">
                        </div>

                        <div class="form-group">
                            <label for="title">Tiêu đề (required)</label>
                            <textarea name="title" id="title" rows="2"></textarea>
                        </div>
            
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea name="description" id="description" rows="18"></textarea>
                        </div>
                    </div>
            
                    <div class="form-right">
                        <div class="form-group">
                            <label for="thumbnail">Đăng tải ảnh bìa</label>
                            <input type="file" id="thumbnail_path" name="thumbnail" accept="image/*">
            
                            <div class="review__thumbnail">
                                <img src="" alt="" id="thumbnail--review" class="thumbnail--img">
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="playlist">Danh sách phát</label>
                            <select id="" name="playlist">
                                <option value="A">Playlist A</option>
                                <option value="B">Playlist B</option>
                            </select>
                        </div>
            
                        <div class="form-group">
                            <label for="privacy">Chế độ</label>
                            <select id="display_mode" name="privacy">
                                <option value="1">Công khai</option>
                                <option value="0">Riêng tư</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="option">
                                <button class="close--btn" id="close--btn">Hủy</button>
                                <button class="save--btn" id="save--btn">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif

    <script>
        $('#thumbnail_path').on("change", function(event) {
            const file = this.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(file);

            $('#thumbnail--review').css("display", "block");
            reader.onload = () => {
                $('#thumbnail--review').attr('src', reader.result);
            };
        });
    
        $('#modal__videoDetails').ready(function() {
            $('#close--btn').on('click', function(event) {
                $('#modal').empty();
                event.preventDefault();
            });
    
            $('#save--btn').on('click', function(event) {
                if ('{{ $flag }}' == 'edit') {
                    $.ajax({
                        url: '{{ route('api.videos.edit') }}',
                        type: 'PUT',
                        data: {
                            video_id: $('#video_id').val(),
                            title: $('#title').val(),
                            description: $('#description').val(),
                            video_path: $('#video_path').val(),
                            thumbnail_path: $('#thumbnail_path').val(),
                            display_mode: $('#display_mode').val(),
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'html',
                        success: function(data) {
                            $('#modal').empty();
                            loadPage({{ $currentPage }}, '{{ route('studio.contents.videos') }}', {{ $itemPerPage }})
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
                        url: '{{ route('api.videos.create') }}',
                        type: 'POST',
                        data: {
                            title: $('#title').val(),
                            description: $('#description').val(),
                            video_path: $('#video_path').val(),
                            thumbnail_path: $('#thumbnail_path').val(),
                            display_mode: $('#display_mode').val(),
                            _token: '{{ csrf_token() }}'
                        },
                        dataType: 'html',
                        success: function(data) {
                            $('#modal').empty();
                            loadPage({{ $currentPage }}, '{{ route('studio.contents.videos') }}', {{ $itemPerPage }})
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
</div>
