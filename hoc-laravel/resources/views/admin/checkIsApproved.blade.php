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

            </div>
            <div class="review-modal-category-title">
                Danh sách danh mục
            </div>
            <div class="review-modal-category-list">
                @foreach ($category as $cate)
                    <div class="review-modal-category-item" id="{{ $cate->category_id }}">{{ $cate->name }}</div>
                @endforeach
                <div class="add-category">Thêm...</div>
            </div>
        </div>

        <div class="review-modal-btn">
            <div class="review-modal-btn-item" id="review-modal-btn-cancel">Hủy</div>
            <div class="review-modal-btn-item" id="review-modal-btn-acp">Duyệt</div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $(document).on('click', '.review-modal-category-item', function() {
            // console.log($(this).text());
            let location_1 = 'review-modal-category-box';
            let location_2 = 'review-modal-category-list';
            var clone = $(this).clone();
            if ($(this).parent().hasClass(location_1)) {
                $(this).remove();
                $('.' + location_2).prepend(clone);
            }
            if ($(this).parent().hasClass(location_2)) {
                $(this).remove();
                $('.' + location_1).prepend(clone);
            }
        });

        $('.add-category').on('click', function() {
            var newCategory = prompt('Nhập tên danh mục mới');
            if (newCategory != null) {
                $('.review-modal-category-box').append('<div class="review-modal-category-item">' +
                    newCategory + '</div>');
                $.ajax({
                    url: "{{ route('admin.createNewCategory') }}",
                    type: 'POST',
                    data: {
                        name: newCategory,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                    }
                
                })
            }
        });

        $('#review-modal-btn-acp').on('click', function() {
            var data = [];
            $('.review-modal-category-box').children().each(function() {
                data.push($(this).attr('id'));
            });

            $.ajax({
                url: "{{ route('admin.acceptVideo') }}",
                type: 'POST',
                data: {
                    video_id: {{ $video->video_id }},
                    category_ids: data,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    console.log(response);
                    if(response.status == 'accept'){
                        alert('Duyệt video thành công');
                        $('#review-modal-btn-cancel').trigger('click');
                        // Xóa phần tử khỏi DOM
                        $('#'+{{ $video->video_id }}).remove();
                    }


                }
            })

            // console.log(data);
        });
    });
</script>
