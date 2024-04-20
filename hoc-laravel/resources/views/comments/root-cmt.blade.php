<div id="comment-section">
    @foreach($comments as $cmt)
        <div class="reply-section">
            <p>{{ $cmt->user->user_name }} - {{ $cmt->created_date }}</p>
            <p>{{ $cmt->content }}</p><br>

            {{--    reply cmt--}}
            @if($cmt->getReplyCommentsByCommentId($cmt->comment_id))
                @component('comments.reply', ['comments' => $cmt->getReplyCommentsByCommentId($cmt->comment_id)])
                @endcomponent
            @endif
        </div>
        {{--    reply form--}}
        <div>
            <form action="{{ route('comments.reply.save') }}" method="post" class="reply-form">
                @csrf
                <input type="hidden" name="video_id" value="{{ $cmt->video->video_id }}">
                <input type="hidden" name="reply_id" value="{{ $cmt->comment_id }}">
                <textarea name="content" id="" cols="30" rows="4" placeholder="trả lời"></textarea>
                <button type="submit">Comment</button>
            </form>
            <hr>
        </div>

    @endforeach


    <script>
        $(document).ready(function () {
            $('#comment-section').on('submit', '.reply-form', function (e) {
                e.preventDefault();
                let form = $(this);
                let url = form.attr('action');
                let data = form.serialize();
                $.ajax({
                    url: url,
                    type: 'post',
                    data: data,
                    success: function (response) {
                        console.log(response);
                        form.trigger('reset');

                        if(response.status === 'not_logged_in'){
                            localStorage.setItem('redirect_after_login', window.location.href);
                            window.location.href = '{{ route('login-register') }}';
                        }
                        else{
                            let comment = `
                                <div>
                                    <p>${response.user_name} - ${response.created_date}</p>
                                    <p>${response.content}</p><br>
                                </div>
                            `;

                            form.parent().prev().append(comment);
                        }


                    }
                });
            });
        });

    </script>

</div>
