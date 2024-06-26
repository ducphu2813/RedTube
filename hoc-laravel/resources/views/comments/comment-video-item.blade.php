<div id="body-comment">
    <div>
        <a id="user-comment-info" href="">

            @if($comment->user->picture_url)
                <img src="{{ asset('storage/img/' . $comment->user->picture_url) }}" alt="" height="50"
                     width="50">
            @else
                <img src="{{ asset('resources/img/defaulftPFP.jpg') }}" alt="" height="50"
                     width="50">

            @endif
        </a>
    </div>
    <div id="channel-name-comment">
        <a href=""><span>{{ $comment->user->user_name }} - <span id="cmt-{{ $comment->comment_id }}">{{ $comment->created_date }}</span></span></a>
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

                {{--form nhập reply--}}
                <input type="text" class="form-control reply-tf" placeholder="Phản hồi..."
                    aria-label="Recipient's username with two button addons"
                >
                <button class="button-cancle" class="btn btn-outline-secondary" type="button">Hủy</button>
                <button class="btn btn-outline-secondary" type="button" id="reply-btn-{{ $comment->comment_id }}">Phản hồi</button>
            </div>
        </div>

        {{-- reply chổ này là reply-wrapper, truyền list các reply của comment này --}}
        @if($comment->getReplyCommentsByCommentId($comment->comment_id))
            @component('comments.comment-reply-wrapper', ['replies' => $comment->getReplyCommentsByCommentId($comment->comment_id), 'comment' => $comment])
            @endcomponent
        @endif
    </div>


    <script>
        $(document).ready(function() {

            //xử lý reply
            $('#reply-btn-{{ $comment->comment_id }}').on('click', function() {

            // $('.reply-btn').on('click', function() {

                // lấy giá trị input gần nhất

                let content = $(this).siblings('.reply-tf').val();
                let comment_id = '{{ $comment->comment_id }}';
                let video_id = '{{ $video->video_id }}';
                let url = '{{ route('comments.reply.save') }}';
                let _token = '{{ csrf_token() }}';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        content: content,
                        reply_id: comment_id,
                        video_id: video_id,
                        _token: _token
                    },
                    success: function(response) {
                        console.log(response);
                        if(response.status === 'not_logged_in'){
                            localStorage.setItem('redirect_after_login', window.location.href);
                            window.location.href = '{{ route('login-register') }}';
                        }
                        else{
                            //trong này, lấy ra 1 element có class là show-comment nằm ngay dưới nó, append thêm 1 reply-item vào
                            let reply = `
                                <div id="user-comment-reply">
                                    <div>
                                        <a id="user-comment-info" href="">
                                            <img src="https://yt3.googleusercontent.com/ytc/AIdro_lCzI--zWxJHl_sZunYFi5uIN_n6okiNy7lZ6FLidxG_0M=s176-c-k-c0x00ffffff-no-rj"
                                                alt="">
                                        </a>
                                    </div>
                                    <div id="channel-name-comment">
                                        <a href=""><span>${response.user_name} - ${response.created_date}</span></a>
                                        <span>
                                            ${response.content}
                                        </span>
                                    </div>
                                </div>
                            `;
                            //lấy element có id là reply-section-id-của-comment-cha và append reply vào
                            $('#reply-section-{{ $comment->comment_id }}').append(reply);
                            $(this).siblings('.reply-tf').val('');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

        });

        var times = formatTime('{{ $comment->created_date }}');
        document.getElementById('cmt-{{ $comment->comment_id }}').textContent = times
    </script>
</div>
