<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/playvideo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/playlistInVideo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/comment.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

{{--    jquery và ajax--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container play-container">
        <div class="row">
            <div class="playvideo">
                <video controls autoplay>
                    <source src="abc.mp4" type="video/mp4">
                </video>
                <div class="tag">
                    <a href="">#Music</a> <a href="">#Trending</a>
                </div>
                <h3 id="title-video">{{ $video->title }}</h3>
                <div class="play-video-infor">
                    <div class="publisher">
                        <img src="OIP.jpg" alt="">
                        <div id="channel-title">
                            <span id="channel-name" class="play-video">{{ $video->user->channel_name }}</span>
                            <span id="channel-subcride" class="play-video">{{ $video->user->followersCount() }} Subscribers</span>
                        </div>
                    </div>
                    @if(!session('loggedInUser'))
                        <button type="button" id="sub-btn">Đăng ký</button>

                    @elseif(session('loggedInUser') == $video->user->user_id)
                        {{--nếu là chính mình thì không hiện nút đăng ký--}}

                    @elseif(session('loggedInUser') && $video->user->isFollowed(session('loggedInUser')))
                        <button type="button" id="sub-btn">Đã Đăng ký</button>

                    @elseif(session('loggedInUser') && !$video->user->isFollowed(session('loggedInUser')))
                        <button type="button" id="sub-btn">Đăng ký</button>

                    @endif
                    <div class="icon">
                        <div class="change-status interact" id="like">
                            <i class="fa-regular fa-thumbs-up"><span class="para">50N</span>
                            </i>
                        </div>
                        <i class="fa-solid fa-window-minimize fa-rotate-90"></i>
                        <div class="change-status interact" id="dislike">
                            <i class="fa-regular fa-thumbs-down"><span class="para">10N</span>
                            </i>
                        </div>
                        <i class="fa-solid fa-window-minimize fa-rotate-90"></i>
                        <div class="change-status">
                            <i class="fa-solid fa-list" onclick="openModal()"><span class="para">Lưu</span></i>

                        </div>
                    </div>
                </div>
                <hr>
                <div class="discription">
                    <p class="expandable-content">
                        <span>
                        </span>
                    <div id="outer">
                        <span id="status-video"></span>
                        <p class="less">
                            {{ $video->description }}
                        </p>
                    </div>
                    </p>
                    <button id="btn-expand">Xem thêm</button>
                </div>
{{--                Phần này là phần comment--}}
                @component('comments.comment-video-wrapper', ['comments' => $video->getRootComments, 'video' => $video])
                @endcomponent
            </div>

{{--            Phần này là phần sidebar, chứa playlist và video đề xuất--}}
            <div class="sidebar">
                {{-- Cái này là cái danh sách hiển thị khi người dùng xem DANH SÁCH PHÁT --}}
{{--                Cái này là playlist bên phải, nếu bấm coi từ playlist thì mới hiện--}}
                @component('video.playlist-in-video-wrapper');
                @endcomponent

                {{-- Cái này là cái danh sách đề xuất video --}}
                @component('video.video-hint-wrapper')
                @endcomponent
            </div>
        </div>
    </div>

{{--    đây là phần thêm video vào playlist--}}
    @component('video.video-modal', ['playlists' => $playlists, 'video' => $video])
    @endcomponent

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous">
    </script>

    <script>
        /* Expandable content */
        document.getElementById("btn-expand").addEventListener("click", function() {
            var content = document.querySelector("#outer p");
            content.classList.toggle("show-more");
            if (content.classList.contains("show-more")) {
                this.textContent = "Thu gọn";
            } else {
                this.textContent = "Xem thêm";
            }
        });

        /* Like and Dislike */
        // document.getElementsByClassName("para").addEventListener("click", function() {
        //     this.classList.toggle("clicked");
        // });
        // var lastClicked = null;
        //
        // function buttonClickHandler() {
        //   if (lastClicked === this) {
        //     // Nếu nút đã được nhấn lần trước là nút này, thì xóa lớp "clicked"
        //     this.classList.remove("clicked");
        //     lastClicked = null;
        //   } else {
        //     // Nếu không, loại bỏ lớp "clicked" từ nút cuối cùng được nhấn (nếu có)
        //     if (lastClicked) {
        //       lastClicked.classList.remove("clicked");
        //     }
        //     // Thêm lớp "clicked" vào nút này và cập nhật biến lastClicked
        //     this.classList.add("clicked");
        //     lastClicked = this;
        //   }
        // }

        // // Lắng nghe sự kiện click cho tất cả các nút like
        // var likeButtons = document.querySelectorAll('.fa-thumbs-up');
        // likeButtons.forEach(function(button) {
        //   button.addEventListener('click', buttonClickHandler);
        // });

        // // Lắng nghe sự kiện click cho tất cả các nút dislike
        // var dislikeButtons = document.querySelectorAll('.fa-thumbs-down');
        // dislikeButtons.forEach(function(button) {
        //   button.addEventListener('click', buttonClickHandler);
        // });


        $(document).ready(function() {

            //thêm sự kiện ajax khi bấm vào thanh input reply
            $('.reply-tf').one('click', function(event) {
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
            });


            //sự kiện cho nút subscribe
            $('#sub-btn').on('click', function() {

                let follower_id = '{{ session('loggedInUser') ? session('loggedInUser') : null }}';
                let user_id = '{{ $video->user->user_id }}';
                $.ajax({
                    url: '{{ route('follow.handle') }}',
                    type: 'POST',
                    data: {
                        user_id: user_id,
                        follower_id: follower_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);

                        if(response.status === 'not_logged_in'){
                            localStorage.setItem('redirect_after_login', window.location.href);
                            window.location.href = '{{ route('login-register') }}';
                        }
                        else{
                            if(response.status === 'followed'){
                                $('#sub-btn').text('Đã Đăng ký');
                            }
                            else if(response.status === 'unfollow'){
                                $('#sub-btn').text('Đăng ký');
                            }
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            //like và dislike
            $('.interact').on('click', function() {
                var react = this.id;
                console.log(react);
                let video_id = '{{ $video->video_id }}';
                let user_id = '{{ session('loggedInUser') ? session('loggedInUser') : null }}';
                $.ajax({
                    url: '{{ route('like.handle') }}',
                    type: 'POST',
                    data: {
                        video_id: video_id,
                        user_id: user_id,
                        react: react,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response);
                        if(response.status === 'not_logged_in'){
                            localStorage.setItem('redirect_after_login', window.location.href);
                            window.location.href = '{{ route('login-register') }}';
                        }
                        else if(response.status === 'liked'){
                            //khi like
                        }
                        else if(response.status === 'disliked'){
                            //khi dislike
                        }
                        else if(response.status === 'unset_react'){
                            //khi hủy like/dislike
                        }

                    },
                    error: function(error) {
                        console.log(error);
                    }

                });
            });
        });

        //xử lý reply
        {{--$('.reply-btn').on('click', function() {--}}

        {{--    // lấy giá trị input gần nhất--}}
        {{--    let content = $(this).siblings('.reply-tf').val();--}}
        {{--    let comment_id = '{{ $comment->comment_id }}';--}}
        {{--    let video_id = '{{ $video->video_id }}';--}}
        {{--    let url = '{{ route('comments.reply.save') }}';--}}
        {{--    let _token = '{{ csrf_token() }}';--}}

        {{--    $.ajax({--}}
        {{--        url: url,--}}
        {{--        type: 'POST',--}}
        {{--        data: {--}}
        {{--            content: content,--}}
        {{--            reply_id: comment_id,--}}
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
        {{--                //trong này, lấy ra 1 element có class là show-comment nằm ngay dưới nó, append thêm 1 reply-item vào--}}
        {{--                let reply = `--}}
        {{--                        <div id="user-comment-reply">--}}
        {{--                            <div>--}}
        {{--                                <a id="user-comment-info" href="">--}}
        {{--                                    <img src="https://yt3.googleusercontent.com/ytc/AIdro_lCzI--zWxJHl_sZunYFi5uIN_n6okiNy7lZ6FLidxG_0M=s176-c-k-c0x00ffffff-no-rj"--}}
        {{--                                        alt="">--}}
        {{--                                </a>--}}
        {{--                            </div>--}}
        {{--                            <div id="channel-name-comment">--}}
        {{--                                <a href=""><span>${response.user_name} - ${response.created_date}</span></a>--}}
        {{--                                <span>--}}
        {{--                                    ${response.content}--}}
        {{--                                </span>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    `;--}}
        {{--                //lấy element có id là reply-section-id-của-comment-cha và append reply vào--}}
        {{--                $('#reply-section-{{ $comment->comment_id }}').append(reply);--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function(error) {--}}
        {{--            console.log(error);--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}

        //định dạng view
        function formatViews(views) {

            if (views >= 1000000000) {
                return (views / 1000000000).toFixed(1) + ' Tỷ';
            } else if (views >= 1000000) {
                return (views / 1000000).toFixed(1) + ' Tr';
            } else if (views >= 10000) {
                return (views / 1000).toFixed(1) + ' N';
            } else {
                return views.toString();
            }
        }

        //định dạng thời gian
        function formatTime(time) {
            const now = new Date();
            const videoTime = new Date(time);
            const diffTime = Math.abs(now - videoTime);
            const diffMinutes = Math.floor(diffTime / (1000 * 60));
            const diffHours = Math.floor(diffTime / (1000 * 60 * 60));
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            const diffMonths = Math.ceil(diffDays / 30);

            if (diffMinutes < 60) {
                return diffMinutes + ' phút trước';
            } else if (diffHours < 24) {
                return diffHours + ' tiếng trước';
            } else if (diffDays <= 30) {
                return diffDays + ' ngày trước';
            } else if (diffDays <= 365) {
                return diffMonths + ' tháng trước';
            } else {
                return videoTime.toLocaleDateString();
            }
        }

        // Sử dụng các hàm này để định dạng lượt xem và thời gian tạo video
        let views = formatViews({{ $video->view }});
        let time = formatTime('{{ $video->created_date }}');

        // Hiển thị lượt xem và thời gian tạo video
        document.getElementById('status-video').textContent = views + ' lượt xem - ' + time;

    </script>
</body>

</html>
