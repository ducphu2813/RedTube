<link rel="stylesheet" href="{{ asset('css/studio/studioProfile.css') }}">

<div class="content__title">Profile</div>

<!-- body -->
<form class="content__body">
    <div class="content__body-info">
        <div class="section_1 w-20">
            <div class="img__wrap">
                <img src="{{ asset('resources/img/ocean.jpg') }}" id="avatar--review" value="">
            </div>

            <input type="file" id="avatar" accept="image/*" value="">
        </div>

        <div class="section_2 w-40">
            <div class="w-100">
                <div class="form-group channel__name">
                    <label class="form-label">Kênh</label>
                    <input type="text" class="form-input">
                </div>
            </div>

            <div class="w-100">
                <div class="form-group username">
                    <label class="form-label" for="">Người dùng</label>
                    <input type="text" class="form-input">
                </div>
            </div>

            <div class="w-100">
                <div class="form-group">
                    <label  class="form-label" for="">Email</label>
                    <input type="text" class="form-input">
                </div>
            </div>

            <div class="w-100">
                <div class="form-group channel__description">
                    <div class="form-label">Giới thiệu</div>
                    <textarea name="" id="" cols="30" rows="10" class="form-input"></textarea>
                </div>
            </div>

            <div class="content__body-save w-100">
                <button class="save--btn">Lưu</button>
            </div>
        </div>

        <div class="section_3 w-40">
            <div class="info__item">
                <div class="info__item--icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <span>12000 subcribers</span>
            </div>

            <div class="info__item">
                <div class="info__item--icon">
                    <i class="fa-brands fa-youtube"></i>
                </div>

                <span>230 videos</span>
            </div>

            <div class="info__item">
                <div class="info__item--icon">
                    <i class="fa-solid fa-eye"></i>
                </div>

                <span>12000000 views</span>
            </div>

            <div class="info__item">
                <div class="info__item--icon">
                    <i class="fa-solid fa-heart"></i>
                </div>

                <span>3256 likes</span>
            </div>

            <div class="info__item">
                <div class="info__item--icon">
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                
                <span>tham gia 12/12/2012</span>
            </div>
        </div>
    </div>
</form>

<script>   


    $('#avatar').on("change", function(event) {
        const file = this.files[0];
        const reader = new FileReader();
        reader.readAsDataURL(file);
        
        reader.onload = () => {
            $('#avatar--review').attr('src', reader.result);
        };
    });
</script>