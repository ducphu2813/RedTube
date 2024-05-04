<link rel="stylesheet" href="{{ asset('css/rightProfile.css') }}">

<div class="content__title">Profile</div>

<!-- body -->
<form class="content__body">
    <div class="content__body-info">
        <div class="section_1 w-30">
            <div class="img__wrap">
                <img src="../assets/img/ocean.jpg" alt="XXX">
            </div>

            <input type="file" id="imageInput" accept="image/*">
        </div>

        <div class="section_2 w-70">
            <div class="w-100">
                <div class="form-group channel__name">
                    <div class="form-label">Tên kênh</div>
                    <input type="text" class="form-input">
                </div>
            </div>

            <div class="w-100">
                <div class="form-group username">
                    <div class="form-label">Tên người dùng</div>
                    <input type="text" class="form-input">
                </div>
            </div>

            <div class="w-100">
                <div class="form-group">
                    <div class="form-label">Email</div>
                    <input type="text" class="form-input">
                </div>
            </div>

            <div class="w-100">
                <div class="form-group">
                    <div class="form-label">Giới thiệu</div>
                    <textarea name="" id="" cols="30" rows="10" class="form-input"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="content__body-save w-100">
        <button class="save--btn">Lưu</button>
    </div>

    <!-- <form class="content__body-pwd">
        <div class="content__title w-100">Mật khẩu</div>
        <div class="w-100">
            <div class="w-100">
                <div class="form-group">
                    <div class="form-label">Mật khẩu</div>
                    <input type="text" class="form-input">                
                </div>
            </div>

            <div class="w-100">
                <div class="form-group">
                    <div class="form-label">Mật khẩu mới</div>
                    <input type="text" class="form-input">                
                </div>
            </div>

            <div class="w-100">
                <div class="form-group">
                    <div class="form-label">Xác nhận mật khẩu</div>
                    <input type="text" class="form-input">                
                </div>
            </div>
        </div>
    </form> -->
</form>

<script>    
    document.addEventListener("DOMContentLoaded", function() {
        const imageInput = document.getElementById("imageInput");
        const imgWrap = document.querySelector(".img__wrap img");

        // Add event listener to the file input
        imageInput.addEventListener("change", function() {
            const file = this.files[0]; // Get the selected file

            if (file) {
                // Read the file as a data URL
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Set the image source to the data URL
                    imgWrap.src = e.target.result;
                };

                // Read the file as data URL
                reader.readAsDataURL(file);
            }
        });
    });
</script>