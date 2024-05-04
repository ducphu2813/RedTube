<link rel="stylesheet" href="{{ asset('css/studio/videoDetailsModal.css') }}">
{{-- <div class="content">
    <div class="content__header">
        <div class="content__title">Video details</div>
    
        <div class="content__option">
            <button class="content__option--btn" id="save">Lưu</button>
        </div>
    </div>
    
    <!-- body -->
    <div class="content__body"> --}}

    {{-- </div>    
</div> --}}
<div id="modal" class="modal--popup">
    <div class="modal__overlay">
        <form action="" class="modal-form" method="post" enctype="multipart/form-data">
            <div class="form-section">
                <div class="form-top">Chi tiết video</div>
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
                        <input type="file" id="thumbnail" name="thumbnail" accept="image/*">
        
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
                        <label for="categogy">Thể loại</label>
                        <select id="categogy" name="categogy">
                            <option value="Tag A">Tag A</option>
                            <option value="Tag B">Tag B</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="option">
                            <button class="close--btn">Hủy</button>
                            <button class="save--btn">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    const fileInput = document.getElementById("thumbnail");
    const previewImg = document.getElementById("thumbnail--review");
    fileInput.addEventListener("change", () => {
        const file = fileInput.files[0];
        const reader = new FileReader();
        reader.readAsDataURL(file);

        previewImg.style.display = "block"; 
        reader.onload = () => {
            previewImg.src = reader.result;
        };
    });
</script>
