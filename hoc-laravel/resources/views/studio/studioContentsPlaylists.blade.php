
<link rel="stylesheet" href="{{ asset('css/studio/studioContentsPlaylists.css') }}">

<ul class="content__body--list">

    <!-- header -->
    <li class="content__body--item list--header" style="font-weight: 700;">
        <div class="item__optionbox">

        </div>

        <div class="item__content">

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

            <div class="item__createdate">{{ $playlist->created_date }}</div>

            <div class="item__count">{{ $playlist->count }}</div>
        </li>
    @endforeach
</ul>

<script>
    $('.content__body--list').ready(function() {
        $('.content__body--list').ready(function() {
            $('.edit--btn').on('click', function(event) {
                var playlist_id = $(this).attr('playlist_id')
                $.ajax({
                    url: '{{ route('playlist.playlistDetails') }}',
                    type: 'GET',
                    data: {
                        playlist_id: playlist_id,
                        currentPage: {{ $currentPage }},
                        itemPerPage: {{ $itemPerPage }}
                    },
                    dataType: 'html',
                    success: function(data) {
                        $('#modal').html(data)
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching content:', error);
                    }
                });
                event.preventDefault();
            });

            $('.delete--btn').on('click', function(event) {
                var playlist_id = $(this).attr('playlist_id')
                $.ajax({
                    url: '{{ route('api.playlists.delete') }}',
                    type: 'DELETE',
                    data: {
                        playlist_id: playlist_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'html',
                    success: function(data) {
                        $('#modal').empty();
                        loadPage(1, '{{ route('studio.contents.playlists') }}', {{ $itemPerPage }})
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching content:', error);
                    }
                });
                event.preventDefault();
            });
            
        });

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


