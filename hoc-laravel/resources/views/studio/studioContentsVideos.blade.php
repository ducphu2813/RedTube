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

            <div class="item__content">
                <div class="item__thumbnail">
                    <img src="../assets/img/ocean.jpg" alt="" class="item__thumbnail--img">
                </div>

                <div class="item__info">
                    <h5 class="item__title">{{ $video->title }}</h5>

                    <div class="item__description">{{ $video->description }}</div>
                </div>
            </div>



            <div class="item__display">
                @if ($video->display_mode == 0)
                    <i class="fa-solid fa-earth-americas"></i>
                    <div class="item__display--text">Riêng tư</div>
                @else
                    <i class="fa-solid fa-lock"></i>
                    <div class="item__display--text">Công khai</div>
                @endif


            </div>

            <div class="item__createdate">{{ $video->created_date }}</div>

            <div class="item__view">{{ $video->view }}</div>

            <div class="item__comment">666</div>

            <div class="item__like">666</div>
        </li>
    @endforeach
</ul>

<script>
    $('.content__body--list').ready(function() {

        // nút edit của video trong studio
        $('.edit--btn').on('click', function(event) {
            var video_id = $(this).attr('video_id')
            $.ajax({
                url: `/studioPage/videoDetails`,
                data: {
                    video_id: video_id
                },
                type: 'GET',
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

        // $('.delete--btn').on('click', function(event) {
        //     var video_id = $(this).attr('video_id')
        //     $.ajax({
        //         url: `/studioPage/videoDetails`,
        //         type: 'GET',
        //         dataType: 'html',
        //         success: function(data) {
        //             $('#modal').html(data)
        //         },
        //         error: function(data) {
        //             console.log(data)
        //         }
        //     });
        //     event.preventDefault();
        // });


        $.ajax({
            url: '{{ route('studio.pagination') }}',
            type: 'GET',
            data: {
                currentPage: {{ $currentPage }},
                itemPerPage: {{ $itemPerPage }},
                totalPages: {{ $totalPages }},
                pageDisplay: {{ $pageDisplay }}
            },
            dataType: 'html',
            success: function(data) {
                $('#body').append(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching content:', error);
                console.log({{ $currentPage }})
            }
        });

    });
</script>
