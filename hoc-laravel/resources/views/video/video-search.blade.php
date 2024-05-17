<link rel="stylesheet" href="{{ asset('css/videoSearch.css') }}">

<div class="video-category-filter">
    <div class="video-category-container">
        @foreach ($listCate as $cate)
        <div class="video-category-item-search" id="{{ $cate->category_id }}">{{ $cate->name }}</div>
        @endforeach

    </div>
</div>

<div id="video-search-wrapper">
    @foreach($videos as $video)
        @component('video.video-in-main-item', ['video' => $video])
        @endcomponent
    @endforeach

</div>

{{-- Sờ cờ ríp cho playVideo tại này --}}
<script>
    $(document).on('click', '.video-category-item-search', function() {
            var cate = [];
            var content = searchValue = $('#search-inp').val().trim().replace(/\s+/g, ' ');
            console.log(content);
            $('.video-category-item-clicked').each(function() {
                cate.push($(this).attr('id'));
            });
            console.log('Cate: ' + cate);
            $.ajax({
                url: "{{ route('clients.filterVideoFromSearch') }}",
                method: 'POST',
                data: {
                    category_ids: cate,
                    keyword: content,
                    _token: "{{ csrf_token() }}"
                },
                cache: false,
                success: function(response) {
                    console.log(response);
                    $('#video-search-wrapper').html(response);
                    // if (response == "") {
                    //     $('#videoWrapper').html(
                    //         "<h2 style='text-align: center; margin-top: 50px'>Không có dữ liệu</h2>"
                    //         );
                    // }
                    // console.log(response.videos);
                    // console.log(response);
                    // bindItemBtnChange(); // Gán lại sự kiện sau khi cập nhật nội dung HTML
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
</script>
