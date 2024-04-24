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
    <h3>Danh sách playlist của bạn</h3>
    @if( $playlists->count() == 0 )
        <p>Chưa có playlist nào</p>
    @else
        @foreach($playlists as $playlist)
            <div>
                <h4>{{ $playlist->name }}</h4>
                @if( $playlist->videos->count() == 0 )
                    <p>Playlist này chưa có video nào</p>
                @else
                    <ul>
                        @foreach($playlist->videos as $video)
                            <li>{{ $video->title }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach

    @endif
</body>
</html>
