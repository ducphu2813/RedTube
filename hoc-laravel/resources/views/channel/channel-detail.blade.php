<ul class="list-container">
    <div class="list-title">Kênh đăng ký</div>
    @foreach ($channels as $channel)
        <li class="list-item" user_id='{{ $channel->user_id }}'>
            <a href="">
                <span class="list-icon">
                    <img src="{{ $channel->picture_url }}" alt="">
                </span>
                
                {{ $channel->channel_name }}
            </a>
        </li>
    @endforeach
</ul>
