<div id="user-comment-reply">
    <div>
        <a id="user-comment-info" href="">
            <img src="https://yt3.googleusercontent.com/ytc/AIdro_lCzI--zWxJHl_sZunYFi5uIN_n6okiNy7lZ6FLidxG_0M=s176-c-k-c0x00ffffff-no-rj"
                alt="">
        </a>
    </div>
    <div id="channel-name-comment">
        <a href=""><span>{{ $reply->user->user_name }} - {{ $reply->created_date }}</span></a>
        <span>
            {{ $reply->content }}
        </span>
    </div>
</div>
