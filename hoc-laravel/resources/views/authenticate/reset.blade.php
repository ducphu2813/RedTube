@extends('layout.app')
@section('title', 'Đặt lại mật khẩu')


@section('content')
    <h1>Đặt mật khẩu mới cho tài khoản của bạn</h1><br>
    <h4>Hãy nhập mật khẩu mới</h4><br>
    <br>

    <form action="#" method="post" id="reset_form">
        @csrf

        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <div class="invalid_feedback"></div>
        </div><br>


        <div>
            <label for="password">Mật khẩu mới</label>
            <input type="password" name="new_password" id="password">
            <div class="invalid_feedback"></div>
        </div><br>

        <div>
            <label for="password_confirmation">Nhập lại Mật khẩu mới</label>
            <input type="password" name="new_password_confirmation" id="password_confirmation">
            <div class="invalid_feedback"></div>
        </div><br>

        <div>
            <input type="submit"
                   value="Xác nhận mật khẩu mới"
                   id="reset_btn"
            >
        </div><br>

        <div class="">
            <a href="{{ route('login-register') }}">Quay lại trang đăng nhập</a>
        </div>


    </form>
@endsection

@section('scripts')

@endsection
