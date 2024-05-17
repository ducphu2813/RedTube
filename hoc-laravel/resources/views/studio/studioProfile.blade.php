{{-- <link rel="stylesheet" href="{{ asset('css/studio/studioProfile.css') }}"> --}}

<div class="content__title">Profile</div>

<!-- body -->
<form class="content__body">
    <div class="content__body-info">
        <div class="section_1 w-20">
            <div class="img__wrap">
                @if($user->picture_url)
                    <img src="{{ asset('storage/img/' . $user->picture_url) }}" id="avatar--review" value="" alt="">
                @else
                    <img src="{{ asset('resources/img/defaulftPFP.jpg') }}" id="avatar--review" value="" alt="">
                @endif
            </div>

            <input name="picture_url" type="file" id="avatar" accept="image/*" value="">
        </div>

        <div class="section_2 w-40">
            <div class="w-100">
                <div class="form-group channel__name">
                    <div class="form-label">Tên kênh</div>
                    <input type="text"
                           class="form-input"
                           value="{{ $user->channel_name }}"
                           name="channel_name"
                    >
                </div>
            </div>

            <div class="w-100">
                <div class="form-group username">
                    <div class="form-label">Tên người dùng</div>
                    <input type="text"
                           class="form-input"
                           value="{{ $user->user_name }}"
                           name="user_name"
                    >
                </div>
            </div>

            <div class="w-100">
                <div class="form-group">
                    <div class="form-label">Email</div>
                    <input type="text"
                           class="form-input"
                           value="{{ $user->email }}"
                           name="email"
                    >
                </div>
            </div>

            <div class="w-100">
                <div class="form-group channel__description">
                    <div class="form-label">Giới thiệu</div>
                    <textarea name="description" id="" cols="30" rows="10" class="form-input">{{ $user->description }}</textarea>
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

                <span>{{ $user->subscribers }} người đăng ký</span>
            </div>

            <div class="info__item">
                <div class="info__item--icon">
                    <i class="fa-brands fa-youtube"></i>
                </div>

                <span>{{ $user->videos }} video</span>
            </div>

            <div class="info__item">
                <div class="info__item--icon">
                    <i class="fa-solid fa-eye"></i>
                </div>

                <span>{{ $user->views }} lượt xem</span>
            </div>

            <div class="info__item">
                <div class="info__item--icon">
                    <i class="fa-solid fa-heart"></i>
                </div>

                <span>{{ $user->likes }} lượt yêu thích</span>
            </div>

            <div class="info__item">
                <div class="info__item--icon">
                    <i class="fa-solid fa-circle-info"></i>
                </div>
                
                <span>tham gia {{ $user->created_date }}</span>
            </div>
        </div>
    </div>
</form>

<script>


    $('#avatar').on("change", function(event) {
        var file = this.files[0];
        var reader = new FileReader();
        reader.readAsDataURL(file);

        reader.onload = () => {
            $('#avatar--review').attr('src', reader.result);
        };
    });

    //event khi lưu profile
    $('.save--btn').on('click', function(event) {
        event.preventDefault();

        // const user_id = $('#user_id').val();
        // const user_name = $('input[name="user_name"]').val();
        // const email = $('input[name="email"]').val();
        // const channel_name = $('input[name="channel_name"]').val();
        // const description = $('textarea[name="description"]').val();
        // var file = $('input[name="picture_url"]')[0].files[0];

        let formData = new FormData();
        formData.append('user_id', $('#user_id').val());
        formData.append('user_name', $('input[name="user_name"]').val());
        formData.append('email', $('input[name="email"]').val());
        formData.append('channel_name', $('input[name="channel_name"]').val());
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('description', $('textarea[name="description"]').val());

        if ($('input[name="picture_url"]')[0].files.length > 0) {
            var fileInput = $('input[name="picture_url"]')[0];
            var clonedFileInput = fileInput.cloneNode(true);
            var file = clonedFileInput.files[0];
            formData.append('picture_url', file);
        }

        // console.log(file);
        // console.log(url);
        // console.log(fileInput);
        // console.log(formData);


        $.ajax({
            url: '{{ route('studio.profileEdit') }}',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                console.log(response);
                if (response.status === 'success') {
                    alert('Cập nhật thành công');
                } else {
                    alert('Cập nhật thất bại');
                }

                if(response && response.picture_url_status === 'isChange') {
                    var asset = '{{ asset('storage/img/') }}/';
                    var picSrc = asset + response.new_picture_url;
                    console.log('có đổi ảnh')
                    // console.log(asset);
                    // console.log(picSrc);
                    $('#avatar-right-corner').attr('src', picSrc);
                    $('#avatar-left-corner').attr('src', picSrc);
                }
                else{
                    console.log('không đổi ảnh')
                }
            },
            error: function(error) {
                console.log(error);
            }
        });

    });


</script>
