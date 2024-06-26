<link rel="stylesheet" href="{{ asset('css/studio/studioContentsVideos.css') }}">

<ul class="content__body--list">

    <!-- header -->
    <li class="content__body--item list--header" style="font-weight: 700;">
        <div class="item__optionbox">

        </div>

        <div class="item__content">

        </div>

        <div class="item__display">
            Chế độ
        </div>

        <div class="item__createdate">
            Ngày tạo
        </div>

        <div class="item__view">Lượt xem</div>

        <div class="item__comment">Bình luận</div>

        <div class="item__like">Lượt thích</div>
    </li>

    <!-- items -->
    {{-- danh sách video của user trong studio--}}
    @foreach ($videos as $video)
        <li class="content__body--item">
            <div class="item__optionbox">
                <button class="item__optionbox--btn edit--btn" video_id='{{ $video->video_id }}'>
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <button class="item__optionbox--btn delete--btn" video_id='{{ $video->video_id }}'>
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <a href="http://127.0.0.1:8000/playVideo/{{ $video->video_id }}">
                <div class="item__content">
                    <div class="item__thumbnail">
                        {{-- phần thumbnail--}}

                        @if($video->thumbnail_path)
                            <img src="{{ asset('storage/thumbnail/' . $video->thumbnail_path) }}" alt="" class="item__thumbnail--img">

                        @else
                            <img src="{{ asset('storage/thumbnail/default-thumbnail.jpg') }}" alt="" class="item__thumbnail--img">

                        @endif

                    </div>

                    <div class="item__info">
                        <h5 class="item__title">{{ $video->title }}</h5>

                        <div class="item__description">{{ $video->description }}</div>
                    </div>
                </div>
            </a>

            <div class="item__display">
                @if ($video->display_mode == 0)
                    <i class="fa-solid fa-lock"></i>
                    <div class="item__display--text">Riêng tư</div>
                @else
                    <i class="fa-solid fa-earth-americas"></i>
                    <div class="item__display--text">Công khai</div>
                @endif


            </div>

            <div class="item__createdate">{{ $video->created_date }}</div>

            <div class="item__view">{{ $video->view }}</div>

            <div class="item__comment">{{ $video->getCommentsCount() }}</div>

            <div class="item__like">{{ $video->getLikesCount() }}</div>
        </li>
    @endforeach
</ul>


<script>
    $('.content__body--list').ready(function() {

        // nút edit của video trong studio
        $('.edit--btn').on('click', function(event) {
            var video_id = $(this).attr('video_id')
            $.ajax({
                url: '{{ route('studio.videoDetails') }}',
                type: 'GET',
                data: {
                    video_id: video_id,
                    currentPage: {{ $currentPage }},
                    itemPerPage: {{ $itemPerPage }}
                },
                dataType: 'html',
                success: function(data) {
                    $('#modal').html(data)
                },
                error: function(data) {
                    console.log(data)
                }
            });
            event.preventDefault();
        });

        //event của nút xóa
        $('.delete--btn').on('click', function(event) {

            if(!confirm('Bạn có chắc chắn muốn xóa video này không?')) return false;

            var video_id = $(this).attr('video_id')
            $.ajax({
                url: '{{ route('api.videos.delete') }}',
                type: 'DELETE',
                data: {
                    video_id: video_id,
                    _token: '{{ csrf_token() }}'
                },
                dataType: 'html',
                success: function(data) {
                    alert('Xóa video thành công')
                    $('#modal').empty();
                    loadPage(1, '{{ route('studio.contents.videos') }}', {{ $itemPerPage }})
                },
                error: function(data) {
                    console.log(data)
                }
            });
            event.preventDefault();
        });


        $.ajax({
            url: '{{ route('studio.pagination') }}',
            type: 'GET',
            data: {
                url: '{{ route('studio.contents.videos') }}',
                currentPage: {{ $currentPage }},
                itemPerPage: {{ $itemPerPage }},
                totalPages: {{ $totalPages }},
                pageDisplay: {{ $pageDisplay }}
            },
            dataType: 'html',
            success: function(data) {
                $('#body').append(data);
            },
            error: function(data) {
                console.log(data)
            }
        });

    });
</script>
