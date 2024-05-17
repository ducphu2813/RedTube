
<link rel="stylesheet" href="{{ asset('css/studio/studioContentsPlaylists.css') }}">

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

        <div class="item__count">Số lượng</div>
    </li>

    <!-- items -->
    @foreach ($playlists as $playlist)
        <li class="content__body--item">
            <div class="item__optionbox">
                <button class="item__optionbox--btn edit--btn" playlist_id='{{ $playlist->playlist_id }}'>
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>

                <button class="item__optionbox--btn delete--btn" playlist_id='{{ $playlist->playlist_id }}'>
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="item__content">
                <div class="item__thumbnail">
                    <img src="../assets/img/ocean.jpg" alt="" class="item__thumbnail--img">
                </div>

                <div class="item__info">
                    <h5 class="item__title">{{ $playlist->name }}</h5>

                    <div class="item__description">{{ $playlist->description }}</div>
                </div>
            </div>

            <div class="item__display">
                @if ($playlist->display_mode == 0)
                    <i class="fa-solid fa-earth-americas"></i>
                    <div class="item__display--text">Riêng tư</div>
                @else
                    <i class="fa-solid fa-lock"></i>
                    <div class="item__display--text">Công khai</div>
                @endif

            </div>

            <div class="item__createdate">{{ $playlist->created_date }}</div>

            <div class="item__count">{{ $playlist->created_date }}</div>
        </li>
    @endforeach
</ul>

<script>
    $('.content__body--list').ready(function() {
    
        $.ajax({
            url: '{{ route('studio.pagination') }}',
            type: 'GET',
            data: {
                url: '{{ route('studio.contents.playlists') }}',
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


