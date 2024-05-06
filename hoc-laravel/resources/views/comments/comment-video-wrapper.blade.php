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
                    <div>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Viết bình luận..."
                                aria-label="Recipient's username with two button addons">
                            <button class="btn btn-outline-secondary" type="button">Hủy</button>
                            <button class="btn btn-outline-secondary" type="button">Bình luận</button>
                        </div>
                    </div>
                </div>

                {{-- Chổ này là all comment của 1 video --}}
                @for ($i = 0; $i < 5; $i++)
                    @component('comments.comment-video-item')
                    @endcomponent
                @endfor

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
</script>