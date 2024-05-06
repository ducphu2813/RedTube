{{--đây là phần tổng thể của comment--}}
{{--function bình luận sẽ làm ở đây--}}
<div id="row-comment" class="row">
    <div class="playvideo">
        <div id="comment" class="play-video">
            <h4>Bình luận</h4>

            <div id="user-comment">
                <div id="header-comment">
                    <div>
                        <a id="user-comment-info" href="">
                            <img src="https://yt3.ggpht.com/yti/ANjgQV-Ho8lAt34jsHEkE6q-KoYttjZutllNyE_xoOQmCoo=s88-c-k-c0x00ffffff-no-rj"
                                alt="">
                        </a>
                    </div>

                    {{-- form nhập comment--}}
                    <div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Viết bình luận..."
                                aria-label="Recipient's username with two button addons"
                                   id="comment-input"
                            >
                            <button class="btn btn-outline-secondary" type="button">Hủy</button>
                            <button class="btn btn-outline-secondary" type="button" id="create-root-cmt">Bình luận</button>
                        </div>
                    </div>

                </div>

                {{-- Chổ này là all comment của 1 video --}}
                {{--chạy vòng lặp foreach để hiển thị tất cả các root comment của video--}}
                <div id="comment-section">
                    @foreach ($comments as $cmt)
                        @component('comments.comment-video-item', ['comment' => $cmt, 'video' => $video])
                        @endcomponent
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    var replyButtons = document.querySelectorAll(".reply");
    replyButtons.forEach(function(button) {
        button.addEventListener("click", function(){
            var userReply = this.parentElement.nextElementSibling;
            userReply.style.display = "block";
        });
    });

    var cancleButtons = document.querySelectorAll(".button-cancle");
    cancleButtons.forEach(function(button) {
        button.addEventListener("click", function(){
            var userReply = this.parentElement.parentElement;
            var input = this.parentElement.querySelector('input');
            input.value = "";
            userReply.style.display = "none";
        });
    });

    //xử lý tạo 1 bình luận mới
    $(document).ready(function() {

        //check login khi bấm vào thanh comment
        $('#comment-input').on('click', function() {

            $.ajax({
                url: '{{ route('check-login') }}', // check login
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Thêm token CSRF để bảo mật
                },
                success: function(response) {
                    // Xử lý khi request thành công
                    console.log(response);
                    if(response.status === 'not_logged_in'){
                        localStorage.setItem('redirect_after_login', window.location.href);
                        window.location.href = '{{ route('login-register') }}';
                    }
                },
                error: function(error) {
                    // Xử lý khi có lỗi xảy ra
                    console.log(error);
                }
            });
        });


        //xử lý tạo root comment
        $('#create-root-cmt').on('click', function() {
            var comment = $('#comment-input').val();
            var video_id = '{{ $video->video_id }}';
            var user_id = '{{ session('loggedInUser') }}';

            $.ajax({
                url: '{{ route('comments.save') }}', // gửi request đến hàm comment trong CommentsController
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Thêm token CSRF để bảo mật
                    content: comment,
                    video_id: video_id,
                    user_id: user_id,
                },
                success: function (response) {
                    // Xử lý khi request thành công
                    console.log(response);

                    if(response.status === 'not_logged_in'){
                        localStorage.setItem('redirect_after_login', window.location.href);
                        window.location.href = '{{ route('login-register') }}';
                    }

                    if (response.status === 'success') {
                        //thêm comment mới vào list comment
                        var newComment = `

                            <div class="body-comment">
                                <div>
                                    <a id="user-comment-info" href="">
                                        <img src="https://yt3.googleusercontent.com/ytc/AIdro_lCzI--zWxJHl_sZunYFi5uIN_n6okiNy7lZ6FLidxG_0M=s176-c-k-c0x00ffffff-no-rj"
                                            alt="">
                                    </a>
                                </div>
                                <div id="channel-name-comment">
                                    <span>
                                        test
                                    </span>
                                    <div id="handle-comment">
                                        <i id="likes" class="fa-regular fa-thumbs-up"></i>
                                        <i id="dislikes" class="fa-regular fa-thumbs-down"></i>
                                        <button class="reply">Phản hồi</button>
                                    </div>
                                    <div id="user-reply">
                                        <div class="input-group">
<!--                                            phần nhập reply-->
                                            <input type="text" class="form-control reply-tf" placeholder="Phản hồi..."
                                                aria-label="Recipient's username with two button addons">

                                            <button class="button-cancle" class="btn btn-outline-secondary" type="button">Hủy</button>
                                            <button class="btn btn-outline-secondary" type="button" id="reply-btn-${response.reply_id}">Phản hồi</button>
                                        </div>
                                    </div>

<!--                                    khúc này là bắt đầu reply của root comment-->

                                </div>
                            </div>
                        `;
                        $('#comment-section').prepend(newComment);
                        $('#comment-input').val('');

                        //thêm lại sự kiện cho các button reply và cancle
                        var replyButtons = document.querySelectorAll(".reply");
                        replyButtons.forEach(function(button) {
                            button.addEventListener("click", function(){
                                var userReply = this.parentElement.nextElementSibling;
                                userReply.style.display = "block";
                            });
                        });

                        var cancleButtons = document.querySelectorAll(".button-cancle");
                        cancleButtons.forEach(function(button) {
                            button.addEventListener("click", function(){
                                var userReply = this.parentElement.parentElement;
                                var input = this.parentElement.querySelector('input');
                                input.value = "";
                                userReply.style.display = "none";
                            });
                        });

                        var requestSent = false;
                        //thêm sự kiện ajax cho các input reply
                        $('.reply-tf').one('click', function(event) {

                            if(requestSent){
                                var currentInput = $(event.target);
                                $.ajax({
                                    url: '{{ route('check-login') }}', // check login
                                    type: 'POST',
                                    data: {
                                        _token: '{{ csrf_token() }}' // Thêm token CSRF để bảo mật
                                    },
                                    success: function(response) {
                                        // Xử lý khi request thành công
                                        console.log(response);
                                        if(response.status === 'not_logged_in'){
                                            localStorage.setItem('redirect_after_login', window.location.href);
                                            window.location.href = '{{ route('login-register') }}';
                                        }
                                        requestSent = true;
                                    },
                                    error: function(error) {
                                        // Xử lý khi có lỗi xảy ra
                                        console.log(error);
                                        requestSent = true;
                                    }
                                });

                            }


                        });

                        //thêm sự kiện ajax cho các button reply
                        {{--$('#reply-btn-'+response.comment_id).on('click', function() {--}}
                        {{--    var content = $(this).parent().prev().val();--}}
                        {{--    var comment_id = response.comment_id;--}}
                        {{--    var video_id = '{{ $video->video_id }}';--}}
                        {{--    var url = '{{ route('comments.reply.save') }}';--}}
                        {{--    var _token = '{{ csrf_token() }}';--}}

                        {{--    $.ajax({--}}
                        {{--        url: url,--}}
                        {{--        type: 'POST',--}}
                        {{--        data: {--}}
                        {{--            content: content,--}}
                        {{--            comment_id: comment_id,--}}
                        {{--            video_id: video_id,--}}
                        {{--            _token: _token--}}
                        {{--        },--}}
                        {{--        success: function(response) {--}}
                        {{--            console.log(response);--}}
                        {{--            if(response.status === 'not_logged_in'){--}}
                        {{--                localStorage.setItem('redirect_after_login', window.location.href);--}}
                        {{--                window.location.href = '{{ route('login-register') }}';--}}
                        {{--            }--}}
                        {{--            else{--}}
                        {{--                // let comment = `--}}
                        {{--                //     <div>--}}
                        {{--                //         <p>${response.user_name} - ${response.created_date}</p>--}}
                        {{--                //         <p>${response.content}</p><br>--}}
                        {{--                //     </div>--}}
                        {{--                // `;--}}
                        {{--                //--}}
                        {{--                // $(this).parent().parent().prev().append(comment);--}}
                        {{--            }--}}
                        {{--        }--}}
                        {{--    });--}}
                        {{--});--}}

                    }
                },
                error: function (error) {
                    // Xử lý khi có lỗi xảy ra
                    console.log(error);
                }

            });
        });

    });
</script>
