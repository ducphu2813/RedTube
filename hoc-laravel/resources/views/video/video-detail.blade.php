<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div>
        <h1>Bạn đang coi video {{ $video->title }}</h1>
        <p>Của kênh:
            <a href="{{ route('users.user-detail', $video->user->user_id) }}">{{ $video->user->channel_name }}</a>
        </p>

        <hr>
        <h4>Comment Section</h4>
{{--        comment form, root comment--}}
        <form action="{{ route('comments.save') }}" method="post" id="root-comment">
            @csrf
            <input type="hidden" name="video_id" value="{{ $video->video_id }}">
            <input type="hidden" name="reply_id" value="{{ null }}">
            <textarea name="content" id="" cols="30" rows="4"></textarea>
            <button type="submit">Comment</button>
        </form>
        <hr>
        @component('comments.root-cmt', ['comments' => $video->getRootComments])
        @endcomponent
    </div>

    <script>
        $(document).ready(function () {
            $('#root-comment').submit(function (e) {
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
                                <div class="reply-section">
                                    <p>${response.user_name} - ${response.created_date}</p>
                                    <p>${response.content}</p><br>
                                </div>
                                <div>
                                    <form action="${response.reply_route}" method="post" class="reply-form">

                                        <input type="hidden" name="_token" value="${response.csrf_token}">
                                        <input type="hidden" name="video_id" value="${response.video_id}">
                                        <input type="hidden" name="reply_id" value="${response.comment_id}">
                                        <textarea name="content" id="" cols="30" rows="4" placeholder="trả lời"></textarea>
                                        <button type="submit">Comment</button>
                                    </form>

                                    <hr>
                                </div>
                            `;

                            $('#comment-section').prepend(comment);
                        }

                    }
                });
            });
        });
    </script>
</body>
</html>
