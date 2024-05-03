<div id="content">
    <div class="container play-container">
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
                        <div id="body-comment">
                            <div>
                                <a id="user-comment-info" href="">
                                    <img src="https://yt3.googleusercontent.com/ytc/AIdro_lCzI--zWxJHl_sZunYFi5uIN_n6okiNy7lZ6FLidxG_0M=s176-c-k-c0x00ffffff-no-rj"
                                        alt="">
                                </a>
                            </div>
                            <div id="channel-name-comment">
                                <a href=""><span>Monsieur Tuna</span></a>
                                <span>
                                    Ôi đây là video hay nhất mà trước giờ được xem. Khi xem nó tôi cảm giác như mình
                                    được quay về thời trẻ, nghĩ đến mình khi ấy thật là vui vẻ. Cảm ơn bạn đã chia sẻ
                                    video này.
                                </span>
                                <div id="handle-comment">
                                    <i id="likes" class="fa-regular fa-thumbs-up"></i>
                                    <i id="dislikes" class="fa-regular fa-thumbs-down"></i>
                                    <button id="reply">Phản hồi</button>
                                </div>
                                <div id="user-reply">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Phản hồi..."
                                            aria-label="Recipient's username with two button addons">
                                        <button id="button-cancle" class="btn btn-outline-secondary"
                                            type="button">Hủy</button>
                                        <button class="btn btn-outline-secondary" type="button">Phản hồi</button>
                                    </div>
                                </div>
                                <div id="expanded-reply">
                                    <div>
                                        <button type="button" class="btn btn-outline-primary">Phản hồi</button>
                                    </div>
                                    <div id="user-comment-reply">
                                        <div>
                                            <a id="user-comment-info" href="">
                                                <img src="https://yt3.googleusercontent.com/ytc/AIdro_lCzI--zWxJHl_sZunYFi5uIN_n6okiNy7lZ6FLidxG_0M=s176-c-k-c0x00ffffff-no-rj"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div id="channel-name-comment">
                                            <a href=""><span>Monsieur Tuna</span></a>
                                            <span>
                                                Ôi đây là video hay nhất mà trước giờ được xem. Khi xem nó tôi cảm giác
                                                như mình được quay về thời trẻ, nghĩ đến mình khi ấy thật là vui vẻ. Cảm
                                                ơn bạn đã chia sẻ video này.
                                            </span>
                                            <div id="handle-comment">
                                                <i id="likes" class="fa-regular fa-thumbs-up"></i>
                                                <i id="dislikes" class="fa-regular fa-thumbs-down"></i>
                                                <button id="reply">Phản hồi</button>
                                            </div>
                                            <div>
                                                <div class="input-group">
                                                    <input type="text" class="form-control"
                                                        placeholder="Viết bình luận..."
                                                        aria-label="Recipient's username with two button addons">
                                                    <button class="btn btn-outline-secondary"
                                                        type="button">Hủy</button>
                                                    <button class="btn btn-outline-secondary" type="button">Phản
                                                        hồi</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Xử lý nút like và dislike
        var lastClicked = null;

        function buttonClickHandler() {
            if (lastClicked === this) {
                // Nếu nút đã được nhấn lần trước là nút này, thì xóa lớp "clicked"
                this.classList.remove("clicked");
                lastClicked = null;
            } else {
                // Nếu không, loại bỏ lớp "clicked" từ nút cuối cùng được nhấn (nếu có)
                if (lastClicked) {
                    lastClicked.classList.remove("clicked");
                }
                // Thêm lớp "clicked" vào nút này và cập nhật biến lastClicked
                this.classList.add("clicked");
                lastClicked = this;
            }
        }

        // Lắng nghe sự kiện click cho tất cả các nút like
        var likeButtons = document.querySelectorAll('.fa-thumbs-up');
        likeButtons.forEach(function(button) {
            button.addEventListener('click', buttonClickHandler);
        });

        // Lắng nghe sự kiện click cho tất cả các nút dislike
        var dislikeButtons = document.querySelectorAll('.fa-thumbs-down');
        dislikeButtons.forEach(function(button) {
            button.addEventListener('click', buttonClickHandler);
        });


        // Xử lý nút phản hồi
        document.getElementById("reply").addEventListener("click", function() {
            var userReply = document.getElementById("user-reply");
            userReply.style.display = "block"; // Hiển thị phần tử khi nhấn vào nút "reply"
        });
        document.getElementById("button-cancle").addEventListener("click", function() {
            var userReply = document.getElementById("user-reply");
            userReply.style.display = "none"; // Ẩn phần tử khi nhấn vào nút "Hủy"
            userReply.querySelector("input").value = ""; // Xóa nội dung trong input
        });
    </script>
