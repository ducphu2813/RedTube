@extends('layout.user-dashboard-layout')
@section('title', 'Chỉnh sửa thông tin tài khoản')

@section('content')
    <h1>Thông tin tài khoản</h1>
    <div class="info-container">
        <div class="info">
            <form action="#"
                  method="POST"
                  id="edit-form"
            >
                @csrf
                <input type="hidden" name="user_id" id="user_id" value="{{ $user->user_id }}">
                <h4>Tên tài khoản: </h4>
                <input type="text" value="{{ $user->user_name }}" name="user_name">
                <h4>Email:</h4>
                <input type="text" value="{{ $user->email }}" name="email">
                <h4>Tên kênh: </h4>
                <input type="text" value="{{ $user->channel_name }}" name="channel_name">
                <h4>Mô tả: </h4>
                <input type="text" value="{{ $user->description }}" name="channel_name">

                <input type="submit"
                       value="Cập nhật"
                       id="update_btn"
                >

            </form>
            <h4>Ảnh đại diện: </h4>
            <div>
                @if($user->picture_url)
                    <img src="{{ asset('storage/img/' . $user->picture_url) }}"
                         alt=""
                         id="user_img"
                         width="200"
                         height="200"
                    >
                @else
                    <img src="{{ asset('resources/img/defaulftPFP.jpg') }}"
                         alt=""
                         id="user_img"
                         width="200"
                         height="200"
                    >
                @endif

                <div>
                    Chọn ảnh mới:
                    <input type="file"
                           name="picture_url"
                           id="picture_update_btn"
                    >
                </div>
            </div>
        </div>
    </div>

    <div>
        <h4>
            Premium hiện tại của bạn
        </h4>
        <ul>
            @if($current_premium == null)
                <li>Hiện không có premium nào</li>
            @else

                <a href="">
                    {{ $current_premium->package->name }}
                </a>

                Mua ngày {{ $current_premium->start_date }}<br>
                Kết thúc vào ngày {{ $current_premium->end_date }}<br>

                Những người mà bạn chia sẻ premium:
                <ul>
                    @if($current_premium->sharedUsers->count() == 0)
                        <li>Không có ai</li>
                    @else
                        @foreach($current_premium->sharedUsers as $shared_premium)
                            <li>
                                {{ $shared_premium->user->user_name }}, vào ngày {{ $shared_premium->created_date }}
                            </li>
                        @endforeach
                    @endif
                </ul>


            @endif
        </ul>

        <h4>Danh sách premium bạn đã mua</h4>
        <ul>
            @if($all_premium->count() == 0)
                <li>Không có premium nào bạn đã mua</li>
            @else
                @foreach($all_premium as $premium)
                    <li>
                        <a href="">
                            {{ $premium->package->name }}
                        </a>
                        Mua ngày {{ $premium->start_date }}<br>
                        Kết thúc vào ngày {{ $premium->end_date }}<br>
                        Những người mà bạn chia sẻ premium:
                        <ul>
                            @if($premium->sharedUsers->count() == 0)
                                <li>Không có ai</li>
                            @else
                                @foreach($premium->sharedUsers as $shared_premium)
                                    <li>
                                        {{ $shared_premium->user->user_name }}, vào ngày {{ $shared_premium->created_date }}
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>
                @endforeach
            @endif
        </ul>


        <h4>Premium bạn đang được chia sẻ</h4>
        <ul>
            @if($current_shared_premium == null)
                <li>Không có premium nào đang được chia sẻ cho bạn</li>
            @else
                <li>
                    <a href="">
                        {{ $current_shared_premium->premiumRegistration->package->name }}
                    </a>
                    Được chia sẻ vào ngày {{ $current_shared_premium->created_date }}<br>
                    Kết thúc vào ngày {{  $current_shared_premium->premiumRegistration->end_date  }}<br>
                    Người chia sẻ: {{ $current_shared_premium->premiumRegistration->user->user_name }}
                </li>
            @endif

        </ul>

        <h4>Các gói premium đã được chia sẻ cho bạn</h4>
        <ul>
            @if($all_shared_premium->count() == 0)
                <li>Không có gói premium nào đã được chia sẻ cho bạn</li>
            @else
                @foreach($all_shared_premium as $shared_premium)
                    <li>
                        <a href="">
                            {{ $shared_premium->premiumRegistration->package->name }}
                        </a>
                        Được chia sẻ vào ngày {{ $shared_premium->created_date }}<br>
                        Kết thúc vào ngày {{  $shared_premium->premiumRegistration->end_date  }}<br>
                        Người chia sẻ: {{ $shared_premium->premiumRegistration->user->user_name }}
                    </li>
                @endforeach
            @endif
        </ul>

    </div>

    <div>
        User role : {{ session('userPermission') }}
    </div>

{{--    <div class="video-list">--}}
{{--        <h2>Danh sách video</h2>--}}
{{--        <ul>--}}
{{--            @if($user->videos->count() == 0)--}}
{{--                <li>Không có video nào</li>--}}

{{--            @else--}}
{{--                @foreach($user->videos as $video)--}}
{{--                    <li>--}}
{{--                        <a href="{{ route('video.detail', ['video_id' => $video->video_id]) }}">{{ $video->title }}</a>--}}
{{--                    </li>--}}
{{--                @endforeach--}}

{{--            @endif--}}

{{--        </ul>--}}
{{--    </div>--}}

    <a href="{{ route('auth.logout') }}">Đăng xuất</a>
@endsection

@section('scripts')
    <script>
        $(function (){
           $('#picture_update_btn').change(function (e){
               const file = e.target.files[0];
               let url = window.URL.createObjectURL(file);
               $('#user_img').attr('src', url);
               let formData = new FormData();
               formData.append('picture_url', file);
               formData.append('user_id', $('#user_id').val());
               formData.append('_token', '{{ csrf_token() }}');

               $.ajax({
                   url: '{{ route('users.update-picture') }}',
                   method: 'POST',
                   data: formData,
                   cache: false,
                   processData: false,
                   contentType: false,
                   dataType: 'json',

                   success:function (response){
                       console.log(response);
                   }


                });
           });
        });
    </script>
@endsection
