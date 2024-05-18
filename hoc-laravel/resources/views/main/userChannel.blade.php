
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

            <div class="user__option">

                {{-- phần nút đăng ký --}}
                @if(!session('loggedInUser'))
                    <button class="btn" id="subcribe--btn">
                        <i class="fa-solid fa-bell"></i>
                        Đăng ký
                    </button>
                @elseif(session('loggedInUser') == $user->user_id)
                    {{-- nếu là chính mình thì không hiện nút đăng ký --}}
                    <button type="button" id="sub-btn" style="visibility: hidden"></button>
                @elseif(session('loggedInUser') && $user->isFollowed(session('loggedInUser')))
                    <button class="btn" id="unsubcribe--btn">
                        <i class="fa-solid fa-bell"></i>
                        Đã đăng ký
                    </button>
                @elseif(session('loggedInUser') && !$user->isFollowed(session('loggedInUser')))
                    <button class="btn" id="subcribe--btn">
                        <i class="fa-solid fa-bell"></i>
                        Đăng ký
                    </button>
                @endif

                @if( ($user->memberships()->exists() && $user->hasMembershipFrom($user->user_id, session('loggedInUser')) ))
                    <button class="btn" id="join--btn">
                        Đã tham gia
                    </button>

                @elseif(session('loggedInUser') == $user->user_id)
                    {{--nếu là chính mình thì không hiện nút tham gia--}}

                @elseif($user->memberships()->exists())
                    <button class="btn" id="join--btn">
                        Tham gia
                    </button>

                @endif

            </div>

        </div>
    </div>

    <ul class="content__option">
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
            data: {
                user_id: {{ $user->user_id }},
            },
            dataType: 'html',
            success: function(data) {
                $('#body').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching content:', error);
                console.log("lolol");
            }
        });

        $('.content__option--item').on('click', function(event) {
            $('.content__option--item').removeClass('selected');
            $(this).addClass('selected');
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    user_id: {{ $user->user_id }},
                },
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

        $('#join--btn').on('click', function(event) {
            $.ajax({
                url: '{{ route('clients.userChannel.membershipModal') }}',
                type: 'GET',
                data: {
                    user_id: {{ $user->user_id }},
                },
                dataType: 'html',
                success: function(data) {
                    $('#modal').html(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error joining channel:', error);
                }
            });
        });
    });
</script>





