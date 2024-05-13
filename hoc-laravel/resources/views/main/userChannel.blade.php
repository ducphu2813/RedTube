
<div class="content__wrap">
    <link rel="stylesheet" href="{{ asset('css/main/userChannel.css') }}">

    <div class="content__header">
        <div class="user__avatar">

            {{-- ảnh đại diện--}}
            @if($user->picture_url)
                <img src="{{ asset('storage/img/' . $user->picture_url) }}" value="" alt="">
            @else
                <img src="{{ asset('resources/img/defaulftPFP.jpg') }}" value="" alt="">
            @endif

        </div>

        <div class="user__section">
            <div class="user__channel">{{ $user->channel_name }}</div>
            <div class="user__info">
                <div class="user__info--item user__name">{{ $user->user_name }}</div>
                <div class="user__info--item user__subscribers">{{ $followers }} lượt đăng ký</div>
                <div class="user__info--item user__videos">{{ $videoCounts }} videos</div>
            </div>

            <div class="user__details">Mô tả</div>

            @if ($logged_user_id != $user->user_id)
                @if ($isFollowing == true)
                    <button id="unsubcribe--btn">
                        <i class="fa-solid fa-bell"></i>
                        Hủy đăng ký
                    </button>
                    @else
                    <button id="subcribe--btn">
                        <i class="fa-solid fa-bell"></i>
                        Đăng ký
                    </button>
                 @endif
            @endif
        </div>
    </div>

    <ul class="content__option">
        {{-- <li class="content__option--item selected">Videos</li>
        <li class="content__option--item">Playlists</li> --}}
        <li class="content__option--item selected" data-url="{{ route('clients.userChannel.videos') }}">Videos</li>
        <li class="content__option--item" data-url="{{ route('clients.userChannel.playlists') }}">Playlists</li>
    </ul>

    <!-- body -->
    <div class="content__body" id="body">

    </div>

    <div class="modal__description">
        <div class="modal__overlay">
            <div class="modal__form">
                <div class="modal__title">Mô tả</div>

                <div class="user__description">
                    {{ $user->description }}
                </div>

                <div class="modal__option">
                    <button id="close--btn">Hủy</button>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ route('clients.userChannel.videos') }}',
            type: 'GET',
            data: {
                'currentPage': 1,
                'itemPerPage': 21
            },
            dataType: 'html',
            success: function(data) {
                $('#body').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching content:', error);
            }
        });

        $('.content__option--item').on('click', function(event) {
            $('.content__option--item').removeClass('selected');
            $(this).addClass('selected');
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    $('#body').html(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching content:', error);
                }
            });

            event.preventDefault();
        });
    });

    set cung cho nay bi sai
    function loadPage(page) {
        $.ajax({
            url: '{{ route('studio.contents.videos') }}',
            type: 'GET',
            data: {
                'currentPage': page
            },
            dataType: 'html',
            success: function(data) {
                $('#body').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching content:', error);
            }
        });
    }
</script> --}}

<script>
    $('#close--btn').on('click', function(event) {
        $('.modal__description').css('display', 'none');
    });

    $('.user__details').on('click', function(event) {
        $('.modal__description').css('display', 'block');
    });

    $(document).ready(function() {
        $.ajax({
            url: '{{ route('clients.userChannel.videos') }}',
            type: 'GET',
            // data: {
            //     // 'currentPage': 1,
            //     'itemPerPage': 999
            // },
            dataType: 'html',
            success: function(data) {
                $('#body').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching content:', error);
            }
        });
    });
</script>





