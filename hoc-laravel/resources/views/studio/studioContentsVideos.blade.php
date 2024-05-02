
<ul class="content__body--list">

    <!-- header -->
    <li class="content__body--item list--header" style="font-weight: 700;">
        <div class="item__optionbox">

        </div>

        <div class="item__content">

        </div>

        <div class="item__display">
            Visibility
        </div>

        <div class="item__createdate">
            Date
        </div>

        <div class="item__view">Views</div>

        <div class="item__comment">Comments</div>

        <div class="item__like">Likes</div>
    </li>

    <!-- items -->
    @foreach ($videos as $video)
        <li class="content__body--item">
            <div class="item__optionbox">
                <button class="item__optionbox--btn" id="edit--btn" video_id='{{ $video->video_id }}'>
                    <i class="fa-solid fa-pen-to-square" id="delete--btn"></i>
                </button>

                <button class="item__optionbox--btn" video_id='{{ $video->video_id }}'>
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
                @if ($video->title == 0)
                    <i class="fa-solid fa-earth-americas"></i>
                @else
                    <i class="fa-solid fa-lock"></i>
                @endif

                <div class="item__display--text">{{ $video->title }}</div>
            </div>

            <div class="item__createdate">{{ $video->created_date }}</div>

            <div class="item__view">{{ $video->view }}</div>

            <div class="item__comment">666</div>

            <div class="item__like">666</div>
        </li>
    @endforeach
</ul>

@component('studio.pagination')
@endcomponent



<script>
    $(document).ready(function() {
        $('#close--btn').on('click', function(event) {
            $('#modal').css({
                display: 'none'
            });
        });

        $('#edit--btn').on('click', function(event) {
            var video_id = $(this).attr('video_id')
            $.ajax({
                url: `videos/${video_id}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#modal').
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching content:', error);
                }
            });
        });
    });
</script>