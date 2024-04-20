<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <h1>Thêm người dùng</h1>
        <form action="{{ route('users.store') }}" method="post">

            {{--        đây là token --}}
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

            {{--        đây là method--}}
            <input type="hidden" name="_method" value="POST">

            @csrf
            <input type="text" name="user_name" placeholder="Tên người dùng"><br>
            <input type="text" name="channel_name" placeholder="Tên kênh"><br>
            <input type="email" name="email" placeholder="Email"><br>
            <input type="password" name="password" placeholder="Mật khẩu">
            <input type="hidden" name="created_date" value="{{ date('Y-m-d H:i:s') }}">
            <input type="hidden" name="active" value="{{ true }}">
            <button type="submit">Thêm</button>
        </form>
    </div>
</body>
</html>
