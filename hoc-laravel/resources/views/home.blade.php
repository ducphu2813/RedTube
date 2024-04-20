<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
</head>
<body>
<div>
    @component('components.header')
    @endcomponent

    <h1>{{ $homeContent  }}</h1>
{{--    <a href="<?php echo route('users.show-form'); ?>">Show form</a><br>--}}
{{--    <a href="<?php echo route('news.detail', ['category' => 'the-thao', 'id' => 13]); ?>">News</a>--}}
    @for($i = 0; $i < 5; $i++)
            @component('components.comm', $componentData)
            @endcomponent
    @endfor

    @component('components.footer')
    @endcomponent
</div>
</body>
</html>
