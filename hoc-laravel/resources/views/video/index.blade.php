<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mainpage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/channelPage.css') }}">
    <link rel="stylesheet" href="{{ asset('css/manageChannelContent.css') }}">
    <link rel="stylesheet" href="{{ asset('icon/fontawesome-free-6.5.1-web/css/all.min.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
</head>

<body style="background-color: #0f0f0f;">
    <div class="warpper" style="width: 100%; height: fit-content; display: flex; flex-direction: row; margin: 0px;">

        @component('video.topChannelPage')
        @component('video.leftChannelPage')

        <div id="content">
            @component('video.rightVideoDetails')
        </div>
    </div>

    <div class="createVideo--modal">

    </div>
</body>

</html>
