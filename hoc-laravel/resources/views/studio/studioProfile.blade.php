<link rel="stylesheet" href="{{ asset('css/studio/studioProfile.css') }}">

<div class="content__title">Profile</div>

<!-- body -->
<form class="content__body">
    <div class="content__body-info">
        <div class="section_1 w-30">
            <div class="img__wrap">
                @if($user->picture_url)
                    <img src="{{ asset('storage/img/' . $user->picture_url) }}" id="avatar--review" value="" alt="">
                @else
                    <img src="{{ asset('resources/img/defaulftPFP.jpg') }}" id="avatar--review" value="" alt="">
                @endif
            </div>

            <input type="file" id="avatar" accept="image/*" value="">
        </div>

        <div class="section_2 w-70">
            <div class="w-100">
                <div class="form-group channel__name">
                    <div class="form-label">Tên kênh</div>
                    <input type="text" class="form-input" value="{{ $user->channel_name }}">
                </div>
            </div>

            <div class="w-100">
                <div class="form-group username">
                    <div class="form-label">Tên người dùng</div>
                    <input type="text" class="form-input" value="{{ $user->user_name }}">
                </div>
            </div>

            <div class="w-100">
                <div class="form-group">
                    <div class="form-label">Email</div>
                    <input type="text" class="form-input" value="{{ $user->email }}">
                </div>
            </div>

            <div class="w-100">
                <div class="form-group">
                    <div class="form-label">Giới thiệu</div>
                    <textarea name="" id="" cols="30" rows="10" class="form-input">{{ $user->description }}</textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="content__body-save w-100">
        <button class="save--btn">Lưu</button>
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

    //event thay đổi avatar


</script>
