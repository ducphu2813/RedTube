<link rel="stylesheet" href="{{ asset('css/studio/videoDetailsModal.css') }}">

<div id="modal__videoDetails" class="modal__popup">
    @if($video->video_id != null)
        <div class="modal__overlay">
            <form action="" class="modal-form" method="post" enctype="multipart/form-data">
                <div class="form-section">
                    <div class="form-top">Chi tiết video</div>
                </div>

                <div class="form-bottom">
                    <div class="form-left">
                        <div class="form-group">
                            <label for="video">Đăng tải video</label>
                            <input type="file" id="video" name="video" accept="video/*" value="{{ $video->video_path }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="title">Tiêu đề (required)</label>
                            <textarea name="title" rows="2">{{ $video->title }}</textarea>
                        </div>
            
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea name="description" rows="18">{{ $video->description }}</textarea>
                        </div>
                    </div>
            
                    <div class="form-right">
                        <div class="form-group">
                            <label for="thumbnail">Đăng tải ảnh bìa</label>
                            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" value="{{ $video->thumbnail_path }}">
            
                            <div class="review__thumbnail">
                                <img src="" alt="" id="thumbnail--review" class="thumbnail--img">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="categogy">Thể loại</label>
                            <input type="text" disabled value="Thể loại A">
                        </div>
            
                        <div class="form-group">
                            <label for="privacy">Chế độ</label>
                            <select id="privacy" name="privacy">
                                <option value="public" {{ $video->display_mode == 1 ? 'selected' : '' }}>Công khai</option>
                                <option value="private" {{ $video->display_mode != 1 ? 'selected' : '' }}>Riêng tư</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="option">
                            
                                <button class="save--btn" id="save--btn" type="button">Lưu</button>
                                <button class="close--btn" id="close--btn-{{ $video->video_id }}">Hủy</button>
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
                    <div class="form-top">Tao video</div>
                </div>

                <div class="form-bottom">
                    <div class="form-left">
                        <div class="form-group">
                            <label for="thumbnail">Đăng tải video</label>
                            <input type="file" id="video" name="video" accept="video/*">
                        </div>

                        <div class="form-group">
                            <label for="title">Tiêu đề (required)</label>
                            <textarea name="title" rows="2"></textarea>
                        </div>
            
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea name="description" rows="18"></textarea>
                        </div>
                    </div>
            
                    <div class="form-right">
                        <div class="form-group">
                            <label for="thumbnail">Đăng tải ảnh bìa</label>
                            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" value="{{ $video->thumbnail_path }}">
            
                            <div class="review__thumbnail">
                                <img src="" alt="" id="thumbnail--review" class="thumbnail--img">
                            </div>
                        </div>
            
                        <div class="form-group">
                            <label for="playlist">Danh sách phát</label>
                            <select id="playlist" name="playlist">
                                <option value="A">Playlist A</option>
                                <option value="B">Playlist B</option>
                            </select>
                        </div>
            
                        <div class="form-group">
                            <label for="privacy">Chế độ</label>
                            <select id="privacy" name="privacy">
                                <option value="public">Công khai</option>
                                <option value="private">Riêng tư</option>
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
        $('#thumbnail').on("change", function(event) {
            const file = this.files[0];
            const reader = new FileReader();
            reader.readAsDataURL(file);

            $('#thumbnail--review').css("display", "block");
            reader.onload = () => {
                $('#thumbnail--review').attr('src', reader.result);
            };
        });
    
        
        $('#modal__videoDetails').ready(function() {
            $('#close--btn-{{ $video->video_id }}').on('click', function(event) {
                $('#modal').empty();
                event.preventDefault();
            });
    
            $('#save--btn').on('click', function(event) {
                
                event.preventDefault();
            });
        });
    </script>
</div>
