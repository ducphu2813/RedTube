@extends('layout.app')
@section('title', 'Quên mật khẩu')


@section('content')
    <h1>Lấy lại mật khẩu</h1><br>
    <h4>Hãy nhập email mà bạn đã đăng ký, chúng tôi sẽ gửi mã xác nhận</h4><br>
    <br>
    <form action="#" method="post" id="forgot_form">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <div class="invalid_feedback"></div>
        </div><br>

        <div>
            <input type="submit"
                   value="Nhận mã xác nhận"
                   id="forgot_btn"
            >
        </div><br>

        <div class="">
            <a href="{{ route('login-register') }}">Quay lại trang đăng nhập</a>
        </div>


    </form>
@endsection

@section('scripts')

@endsection
