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

                    {{-- phần comment--}}
                    <div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Viết bình luận..."
                                aria-label="Recipient's username with two button addons"
                                   id="comment-input"
                            >
                            <button class="btn btn-outline-secondary" type="button">Hủy</button>
                            <button class="btn btn-outline-secondary" type="button">Bình luận</button>
                        </div>
                    </div>
                </div>

                {{-- Chổ này là all comment của 1 video --}}
                {{--chạy vòng lặp foreach để hiển thị tất cả các root comment của video--}}
                @foreach ($comments as $cmt)
                    @component('comments.comment-video-item', ['comment' => $cmt])
                    @endcomponent
                @endforeach

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



    });
</script>
