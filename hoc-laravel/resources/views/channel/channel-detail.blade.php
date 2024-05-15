<ul class="list-container">
    <div class="list-title">Kênh đăng ký</div>

    @if($followings->count() <= 0)
        {{-- nếu chưa đăng ký kênh nào--}}
        <li class="list-item">
            <a href="">
                <span class="list-icon">
                    <img src="{{ asset('resources/img/ocean.jpg') }}" alt="">
                </span>
                Không 1 ai
            </a>
        </li>
    @else
        {{-- nếu đã đăng ký kênh --}}
        @foreach($followings as $following)
            <li class="list-item" user_id='{{ $following->user->user_id }}'>
                <a href="{{ route('clients.userChannel') }}">
                <span class="list-icon">
                    {{--icon avatar trong 1 component kênh đăng ký--}}
                    @if($following->user->picture_url)
                        <img src="{{ asset('storage/img/' . $following->user->picture_url) }}" alt="" width="24" height="24">
                    @else
                        <img src="{{ asset('resources/img/defaulftPFP.jpg') }}" alt="" width="24" height="24">

                    @endif

{{--                    <img src="{{ asset('resources/img/ocean.jpg') }}" alt="">--}}
                </span>
                    {{ $following->user->channel_name }}
                </a>
            </li>
        @endforeach
    @endif

{{--    @for ($i = 0; $i < 6; $i++)--}}
{{--        <li class="list-item">--}}
{{--            <a href="">--}}
{{--                <span class="list-icon">--}}
{{--                    <img src="{{ asset('resources/img/ocean.jpg') }}" alt="">--}}
{{--                </span>--}}
{{--                Channel Name--}}
{{--            </a>--}}
{{--        </li>--}}
{{--    @endfor--}}
</ul>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

<script>
    $(".list-container").ready(function() {
        $(".user-item").on('click', function(event) {
            var user_id = $(this).attr('user_id');

            $.ajax({
                url: '{{ route('clients.userChannel') }}',
                type: 'GET',
                data: {
                    user_id: user_id
                },
                dataType: 'html',
                success: function(data) {
                    $('#content').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown, data) {
                    console.log('AJAX error:', textStatus, errorThrown);
                }
            });
            event.preventDefault();
        });
    });
</script>
