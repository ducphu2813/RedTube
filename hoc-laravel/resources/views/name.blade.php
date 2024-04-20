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
    <form method="POST"
          action="/name"
    >
        {{--        đây là token --}}
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

        {{--        đây là method--}}
        <input type="hidden" name="_method" value="POST">


        <input type="text" name="name" placeholder="nhập tên mày vào"/>

        <br>

        <button type="submit">Submit</button>
    </form>
</body>
</html>
