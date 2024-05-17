<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    {{--    jquery và ajax --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="card">
        <div class="card-top border-bottom text-center">
            <a href="http://127.0.0.1:8000/home">Quay về</a>
            <span id="logo">Thanh Toán đơn hàng</span>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-7">
                    <div class="left border">
                        <div class="row">
                            <span class="header">Điền thông tin của bạn</span>
                        </div>
                        <form>
                            <span>Tên người thanh toán</span>
                            <input class="input-field" placeholder="VD: Nguyễn Văn A" required>

                            <span>Số điện thoại</span>
                            <input type="number" class="input-field" placeholder="VD: 1234 567 890" required>

                            <span>Địa chỉ</span>
                            <input type="text" class="input-field" placeholder="VD: Đường ABC, huyện Z, thành phố GG" required>

{{--                            <input type="checkbox" id="save_card" class="align-left">--}}
                            <label for="save_card">Lưu ý: Chúng tôi sẽ lưu thông tin cá nhân của bạn</label>
                        </form>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="right border">
                        <div class="header">Đơn hàng của bạn</div>
                        <input type="hidden" pack_id="{{ $pack_id }}">
                        @if($flag == 'premium')

                            <div class="row item">
                                <div class="col-4 align-self-center"><img class="img-fluid" src="{{ asset('resources/img/youtube.svg') }}"></div>

                                <div class="col-8">
                                    <div class="row"><b>{{ $premium->price }}₫</b></div>
                                    <div class="row text-muted">Premium: {{ $premium->name }}</div>
                                    <div class="row">Có thể chia sẻ: {{ $premium->share_limit - 1 }}</div>
                                </div>
                            </div>

                        @elseif($flag == 'membership')
                            <div class="row item">
                                @if ($membership->user->picture_url)
                                    <div class="col-4 align-self-center"><img class="img-fluid" src="{{ asset('storage/img/' . $membership->user->picture_url) }}"></div>

                                @else
                                    <div class="col-4 align-self-center"><img class="img-fluid" src="{{ asset('resources/img/defaulftPFP.jpg') }}"></div>

                                @endif
                                <div class="col-8">
                                    <div class="row"><b>{{ $membership->price }}₫</b></div>
                                    <div class="row text-muted">{{ $membership->name }}</div>
                                    <div class="row">Của kênh: {{ $membership->user->channel_name }}</div>
                                </div>
                            </div>
                        @endif
                        <hr>
                        <div class="row lower">
                            <div class="col text-left"><b>Tổng tiền</b></div>
                            <div class="col text-right"><b>{{ $membership->price ?? $premium->price }}₫</b></div>
                        </div>
                        <button class="btn btn-danger btn-confirm">Xác nhận thanh toán</button>
                    </div>
                </div>
            </div>
        </div>

        <div>
        </div>
    </div>

    <script>
        //event cho nút xác nhận thanh toán
        $('.btn-confirm').click(function (event) {

            event.preventDefault();
            let pack_id = $('input[pack_id]').attr('pack_id');
            let name = $('.input-field').eq(0).val();
            let phone = $('.input-field').eq(1).val();
            let address = $('.input-field').eq(2).val();
            let flag = '{{ $flag }}';
            let amount = '{{ $membership->price ?? $premium->price }}';

            //Validation
            if (name == '' || phone == '' || address == '') {
                alert('Vui lòng điền đầy đủ thông tin');
                return;
            }

            $.ajax({
                url: '{{ route('payment.handle') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    pack_id: pack_id,
                    name: name,
                    phone: phone,
                    address: address,
                    flag: flag,
                    amount: amount
                },
                success: function(data) {
                    console.log(data);
                    alert('Thanh toán thành công');
                    window.location.href = '/home';
                },
                error: function(data) {
                    console.log(data);
                },
            })
        });
    </script>
</body>
</html>
