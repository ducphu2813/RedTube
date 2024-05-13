<link rel="stylesheet" href="{{ asset('css/checkModal.css') }}">
<div class="review-modal-container" id="{{ $video->video_id }}">
    <div class="review-modal-leftsection">
        <div class="review-modal-info">
            <div class="review-modal-video">
                <video controls>
                    <source src="{{ asset('storage/video/' . $video->video_path) }}" type="video/mp4">
                </video>
            </div>
            <div class="review-modal-title">
                {{ $video->title }}
            </div>
        </div>
    </div>
    <div class="review-modal-rightsection">

        <div>
            <div class="review-modal-category-title">
                Danh sách danh mục đã chọn
            </div>
            <div class="review-modal-category-box">
                {{-- <div class="review-modal-category-item">Test 1</div>
                <div class="review-modal-category-item">Test 2</div>
                <div class="review-modal-category-item">Test 3</div>
                <div class="review-modal-category-item">Test 1</div>
                <div class="review-modal-category-item">Test 2</div>
                <div class="review-modal-category-item">Test 3</div>
                <div class="review-modal-category-item">Test 1</div>
                <div class="review-modal-category-item">Test 2</div>
                <div class="review-modal-category-item">Test 3</div> --}}
            </div>
            <div class="review-modal-category-title">
                Danh sách danh mục
            </div>
            <div class="review-modal-category-list">
                <div class="review-modal-category-item">Trò chơi</div>
                <div class="review-modal-category-item">Âm nhạc</div>
                <div class="review-modal-category-item">Giải trí</div>
                <div class="review-modal-category-item">Giáo dục</div>
                <div class="review-modal-category-item">Hài kịch</div>
                <div class="review-modal-category-item">Điện ảnh</div>
                <div class="review-modal-category-item">Thể thao</div>
                <div class="review-modal-category-item">Mẹo vặt</div>
                <div class="review-modal-category-item">Du lịch</div>
                <div class="review-modal-category-item">Ẩm thực</div>
                <div class="review-modal-category-item">Văn hóa</div>
                <div class="add-category">Thêm...</div>
            </div>
        </div>

        <div class="review-modal-btn">
            <div class="review-modal-btn-item" id="review-modal-btn-cancel">Hủy</div>
            <div class="review-modal-btn-item">Duyệt</div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.review-modal-category-item', function() {
            console.log($(this).text());
            let location_1 = 'review-modal-category-box';
            let location_2 = 'review-modal-category-list';
            var clone = $(this).clone();
            if($(this).parent().hasClass(location_1)){
                $(this).remove();
                $('.' + location_2).append(clone);
            }
            if($(this).parent().hasClass(location_2)){
                $(this).remove();
                $('.' + location_1).append(clone);
            }
        });

        $('.add-category').on('click', function() {
            var newCategory = prompt('Nhập tên danh mục mới');
            if (newCategory != null) {
                $('.review-modal-category-box').append('<div class="review-modal-category-item">' + newCategory + '</div>');
            }
        });
    });
</script>