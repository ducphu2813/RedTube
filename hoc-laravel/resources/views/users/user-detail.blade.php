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
    <h1>Chi tiết người dùng</h1>
    <div>
        <p>{{ $user->user_id }}</p>
        <p>{{ $user->user_name }}</p>
        <p>{{ $user->email }}</p>
        <hr>
    </div>

    <div>
        <h3>Danh sách video của {{ $user->user_name }}</h3>
        <ul>
{{--            kiểm tra xem user có video nào không--}}
            @if($user->videos->count() == 0)
                <li>Không có video nào</li>
            @endif
            @foreach($user->videos as $video)
                <li>
                    <a href="{{ route('video.detail', ['video_id' => $video->video_id]) }}">{{ $video->title }}</a>
                </li>
            @endforeach
        </ul>
    </div>

</body>
</html>
