@extends('layout.app')
@section('title', 'Tham gia vào nền tảng chia sẻ video lớn nhất thế giới')

@section('content')
    <div id="wrap">
        <div class="modal">
            <div class="sub-modal" id="sub-modal">
                <h1>Welcome to
                    <div>RedTube</div>
                </h1>
                <input type="submit" value="ĐĂNG KÝ" onclick="changeStatus()" class="change-btn btn-hover">
            </div>
            <form class="form-container" id="form-sign-in" action="{{ route('auth.login') }}" method="POST">
                @csrf
                <div class="form">
                    <h1>Đăng nhập</h1>
                    <div class="input-group">

                        <input type="text" placeholder="Tên tài khoản" name="user_name" id="login_username">
                        <div class="invalid_feedback"></div>

                        <input type="password" name="password" placeholder="Mật khẩu" id="login_password">
                        <div class="invalid_feedback"></div>

                        {{--                        end input group --}}
                    </div>

                    <br><br>

                    <div class="forgot-password">
                        <a href="{{ route('forgot') }}">Quên mật khẩu?</a>
                    </div>

                    <button type="submit" class="sign-in-btn btn-hover" id="sign-in-btn">Đăng nhập</button>

                    <div class="list-btn">
                        <i class="sign-in-icon"><svg style="width: 20px;" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 488 512">
                                <path
                                    d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z" />
                            </svg></i>
                    </div>
                </div>
            </form>



            <form class="form-container" id="form-sign-up" style="display: none;" action="#" method="POST">
                @csrf
                <div class="form">
                    <h1>Đăng ký</h1>
                    <div class="input-group">
                        <input type="text" placeholder="Tên tài khoản" name="user_name" id="register_user_name">
                        <div class="invalid_feedback"></div>

                        <input type="email" placeholder="Email" name="email" id="register_email">
                        <div class="invalid_feedback"></div>

                        <input type="password" placeholder="Mật khẩu" name="password" id="register_password">
                        <div class="invalid_feedback"></div>

                        <input type="password" placeholder="Nhập lại mật khẩu" name="confirm_password"
                            id="register_confirm_password">
                        <div class="invalid_feedback"></div>

                    </div>

                    <button class="sign-in-btn btn-hover" id="sign-up-btn">Đăng ký</button>

                </div>
            </form>

        </div>
    </div>
@endsection

@section('scripts')
    {{--    phần script cho chức năng đăng nhập --}}
    <script>
        $(function() {
            $('#form-sign-in').submit(function(e) {
                e.preventDefault();
                $('#sign-in-btn').text('Đang xử lý...');

                $.ajax({
                    url: '{{ route('auth.login') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',

                    success: function(response) {
                        console.log(response);
                        if (response.status === 200) {

                            //khi đăng nhập thành công
                            //lấy ra url mà người dùng muốn truy cập trước khi đăng nhập/đăng ký
                            let redirectUrl = localStorage.getItem('redirect_after_login');

                            if (redirectUrl) {
                                //chuyển về trang trước đó khi chưa đăng nhập
                                window.location.href = redirectUrl;
                                localStorage.removeItem('redirect_after_login');
                            } else {
                                //nếu không có url trước đó, chuyển về trang dashboard
                                window.location.href = '{{ route('users.dashboard') }}';
                            }
                        }

                        if (response.status === 400) {
                            $('#sign-in-btn').text('Đăng nhập');
                            //khi đăng nhập thất bại, hiện các message validate lên
                            var invalidUsername = document.getElementById('login_username').nextElementSibling;
                            var invalidPassword = document.getElementById('login_password').nextElementSibling;
                            if(response.message.user_name === undefined){
                                response.message.user_name = '';
                            }
                            if(response.message.password === undefined){
                                response.message.password = '';
                            }
                            invalidUsername.innerText = response.message.user_name;
                            invalidPassword.innerText = response.message.password;
                        }
                    }

                });
            });
        });
    </script>

    {{--    phần script cho chức năng đăng ký --}}
    <script>
        $(function() {
            $('#form-sign-up').submit(function(e) {
                e.preventDefault();
                $('#sign-up-btn').text('Đang xử lý...');

                $.ajax({

                    url: '{{ route('auth.register') }}',
                    method: 'POST',
                    data: $(this).serialize(), // serialize() giúp lấy tất cả dữ liệu từ form
                    dataType: 'json', //chuyển dữ liệu về dạng json

                    success: function(response) {

                        console.log(response);
                        if (response.status === 200) {
                            //khi đăng ký thành công

                            //lấy ra url mà người dùng muốn truy cập trước khi đăng nhập/đăng ký
                            let redirectUrl = localStorage.getItem('redirect_after_login');

                            if (redirectUrl) {
                                //chuyển về trang trước đó khi chưa đăng ký
                                window.location.href = redirectUrl;
                                localStorage.removeItem('redirect_after_login');
                            } else {
                                //nếu không có url trước đó, chuyển về trang dashboard
                                window.location.href = '{{ route('users.dashboard') }}';
                            }
                        }

                        if (response.status === 400) {
                            $('#sign-up-btn').text('Đăng ký');


                            //khi đăng ký thất bại, hiện các message validate lên
                            var fields = ['user_name', 'password', 'email', 'confirm_password'];
                            
                            fields.forEach(function(field) {
                                if(response.message[field] === undefined) {
                                    response.message[field] = '';
                                }
                            });

                            fields.forEach(function(field) {
                                var invalidField = document.getElementById('register_' + field).nextElementSibling;
                                invalidField.innerText = response.message[field];
                            });    
                        }
                    }
                });
            });
        });
    </script>
@endsection
