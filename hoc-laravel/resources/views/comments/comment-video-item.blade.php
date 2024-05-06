<div id="body-comment">
    <div>
        <a id="user-comment-info" href="">
            <img src="https://yt3.googleusercontent.com/ytc/AIdro_lCzI--zWxJHl_sZunYFi5uIN_n6okiNy7lZ6FLidxG_0M=s176-c-k-c0x00ffffff-no-rj"
                alt="">
        </a>
    </div>
    <div id="channel-name-comment">
        <a href=""><span>{{ $comment->user->user_name }} - {{ $comment->created_date }}</span></a>
        <span>
            {{ $comment->content }}
        </span>
        <div id="handle-comment">
            <i id="likes" class="fa-regular fa-thumbs-up"></i>
            <i id="dislikes" class="fa-regular fa-thumbs-down"></i>
            <button class="reply">Phản hồi</button>
        </div>
        <div id="user-reply">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Phản hồi..."
                    aria-label="Recipient's username with two button addons">
                <button class="button-cancle" class="btn btn-outline-secondary" type="button">Hủy</button>
                <button class="btn btn-outline-secondary" type="button">Phản hồi</button>
            </div>
        </div>

        {{-- reply chổ này là reply-wrapper, truyền list các reply của comment này --}}
        @if($comment->getReplyCommentsByCommentId($comment->comment_id))
            @component('comments.comment-reply-wrapper', ['replies' => $comment->getReplyCommentsByCommentId($comment->comment_id)])
            @endcomponent
        @endif
    </div>
</div>
