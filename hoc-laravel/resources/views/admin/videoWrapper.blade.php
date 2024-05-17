<div class="review-all-header">Video đã duyệt</div>
<div class="filter-btn">Lọc</div>
<div class="video-category-filter">
    <div class="video-category-container">
        @foreach ($listCate as $cate)
            <div class="video-category-item" id="{{ $cate->category_id }}">{{ $cate->name }}</div>
        @endforeach
    </div>

    <div class="video-category-btn-list">
        <button class="video-category-btn-item btn btn-danger" id="cancel-cate">Hủy</button>
        <button class="video-category-btn-item btn btn-success" id="find-by-cate">Xem kết quả</button>
    </div>

</div>

<div class="video-filter">
    <input type="radio" id="all" name="isapproved" value="1" route="{{ route('admin.videoManager') }}"
        checked>
    <label for="all">Tất cả</label><br>

    <input type="radio" id="accept" name="isapproved" value="2" route="{{ route('admin.filterVideo') }}">
    <label for="accept">Chấp nhận</label><br>

    <input type="radio" id="reject" name="isapproved" value="3" route="{{ route('admin.filterVideo') }}"">
    <label for="reject">Từ chối</label>
</div>

<div id="videoWrapper">
    @foreach ($listVideo as $video)
        @component('admin.videoItem', ['video' => $video])
        @endcomponent
    @endforeach
</div>

<script>
    $(document).ready(function() {
        function bindItemBtnChange() {
            $('.item-container').on('change', '.item-btn', function() {
                var status;
                var id = $(this).parent().attr('id');
                if ($(this).find('input').is(":checked")) {
                    if (confirm("Bạn có muốn khóa Video?")) {
                        status = 0;
                    } else {
                        $(this).find('input').prop('checked', false);
                    }
                } else {
                    if (confirm("Bạn có muốn mở khóa Video?")) {
                        status = 1;
                    } else {
                        $(this).find('input').prop('checked', true);
                    }
                }
                console.log(status);
                console.log(id);
                $.ajax({
                    url: "{{ route('admin.changeStatusVideo') }}",
                    method: 'POST',
                    data: {
                        video_id: id,
                        is_approved: status,
                        _token: "{{ csrf_token() }}"
                    },
                    cache: false,
                    success: function(response) {
                        alert("Thay đổi trạng thái");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });
        }

        // sử dụng delegation trong jQuery để gán sự kiện
        bindItemBtnChange();

        $(document).on('click', 'input[type=radio][name=isapproved]', function() {
            var cate = [];
            $('.video-category-item-clicked').each(function() {
                cate.push($(this).attr('id'));
            });
            var status = $('input[type=radio][name=isapproved]:checked').val();
            // var url = $(this).attr('route');
            // console.log(url);
            $.ajax({
                url: "{{ route('admin.filterVideo') }}",
                method: 'POST',
                data: {
                    is_approved: status,
                    category_ids: cate,
                    _token: "{{ csrf_token() }}"
                },
                cache: false,
                success: function(response) {
                    $('#videoWrapper').html(response);
                    if(response == "") {
                        $('#videoWrapper').html("<h2 style='text-align: center; margin-top: 50px'>Không có dữ liệu</h2>");
                    }
                    // console.log(response.videos);
                    // console.log(response);
                    bindItemBtnChange(); // Gán lại sự kiện sau khi cập nhật nội dung HTML
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        $(document).on('click', '#find-by-cate', function() {
            var cate = [];
            $('.video-category-item-clicked').each(function() {
                cate.push($(this).attr('id'));
            });
            var status = $('input[type=radio][name=isapproved]:checked').val();
            $.ajax({
                url: "{{ route('admin.filterVideo') }}",
                method: 'POST',
                data: {
                    is_approved: status,
                    category_ids: cate,
                    _token: "{{ csrf_token() }}"
                },
                cache: false,
                success: function(response) {
                    $('#videoWrapper').html(response);
                    // console.log(response);
                    if(response == "") {
                        $('#videoWrapper').html("<h2 style='text-align: center; margin-top: 50px'>Không có dữ liệu</h2>");
                    }
                    bindItemBtnChange(); // Gán lại sự kiện sau khi cập nhật nội dung HTML
                },
                error: function(response) {
                    console.log(response);
                }
            });
            $('.video-category-filter').removeClass('show');
        });

        $(document).on('click', '#cancel-cate', function() {
            var cate = [];
            $('.video-category-item').each(function() {
                $(this).removeClass('video-category-item-clicked');
            });
            $('input[type=radio][name=isapproved]').eq(0).prop('checked', true);
            $('input[type=radio][name=isapproved]').eq(0).prop('checked', true).trigger('click');
            $('.video-category-filter').removeClass('show');
        });

        $('.video-category-item').click(function() {
            $(this).toggleClass('video-category-item-clicked');
        })

        $('.filter-btn').click(function() {
            $('.video-category-filter').toggleClass('show');
        });

        // Pagi
        // $.ajax({
        //     url: '{{ route('studio.pagination') }}',
        //     type: 'GET',
        //     data: {
        //         url: '{{ route('admin.videoManager') }}',
        //         currentPage: {{ $currentPage }},
        //         itemPerPage: {{ $itemPerPage }},
        //         totalPages: {{ $totalPages }},
        //         pageDisplay: {{ $pageDisplay }}
        //     },
        //     dataType: 'html',
        //     success: function(data) {
        //         $('#videoWrapper').append(data);
        //     },
        //     error: function(xhr, status, error) {
        //         console.error('Error fetching content:', error);
        //         console.log({{ $currentPage }})
        //     }
        // });

        // load lại
        // window.loadPage = function(page, url, itemPerPage) {
        //     $.ajax({
        //         url: url,
        //         type: 'GET',
        //         data: {
        //             currentPage: page,
        //             itemPerPage: itemPerPage
        //         },
        //         dataType: 'html',
        //         success: function(data) {
        //             // console.log(data)
        //             $('#leftsection').html(data);
        //         },
        //         error: function(data) {

        //             console.log(data)
        //         }
        //     });
        // }


        // Load page đầu
        // $.ajax({
        //     url: '{{ route('admin.videoManager') }}',
        //     type: 'GET',
        //     data: {
        //         currentPage: 1,
        //         itemPerPage: 10
        //     },
        //     dataType: 'html',
        //     success: function(data) {
        //         $('#body').html(data);
        //     },
        //     error: function(xhr, status, error) {
        //         console.error('Error fetching content:', error);
        //     }
        // });

    });
</script>
