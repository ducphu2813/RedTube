{{--cái này là 1 reply--}}
<div id="user-comment-reply">
    <div>
        <a id="user-comment-info" href="">

            @if($reply->user->picture_url)
                <img src="{{ asset('storage/img/' . $reply->user->picture_url) }}" alt="" height="40"
                     width="40">
            @else
                <img src="{{ asset('resources/img/defaulftPFP.jpg') }}" alt="" height="40"
                     width="40">

            @endif
        </a>
    </div>
    <div id="channel-name-comment">
        <a href=""><span>{{ $reply->user->user_name }} - <span id="cmt-{{ $reply->comment_id }}"></span></span></a>
        <span>
            {{ $reply->content }}
        </span>
    </div>

    <script>
        var times = formatTime('{{ $reply->created_date }}');
        document.getElementById('cmt-{{ $reply->comment_id }}').textContent = times
    </script>
</div>
