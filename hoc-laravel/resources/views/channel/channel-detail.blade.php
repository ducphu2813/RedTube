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
            <li class="list-item">
                <a href="">
                <span class="list-icon">
                    {{--icon avatar trong 1 component video--}}
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
