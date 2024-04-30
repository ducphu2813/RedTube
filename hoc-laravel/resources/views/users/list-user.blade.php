<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Danh sách người dùng</h1>
    <input id="search-bar" type="text" placeholder="Tìm theo id">
    <input id="search-bar2" type="text" placeholder="Tìm theo tên">

    <div id="list-users">

    </div>
<script>
    $(document).ready(function() {

        $.ajax({
            url: '{{ route('users.all') }}',
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                // var users = '';
                // $.each(data, function(key, value){
                //     users += '<p>' + value.name + '</p>'; // Thay đổi dựa trên cấu trúc dữ liệu trả về
                // });
                $('#list-users').html(data);
                console.log(data);
            },
            error: function(error) {
                console.log(error);
            }
        });

        $('#search-bar').on('keyup', function(event) {
            if(event.keyCode === 13){
                var userId = $(this).val();
                $.ajax({
                    url: '/users/' + userId,
                    type: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        $('#list-users').html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                // event.preventDefault();
            }
        });

        $('#search-bar2').on('keyup', function(event) {
            if(event.keyCode === 13){
                var userName = $(this).val();
                $.ajax({
                    url: '/users/name/' + userName,
                    type: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        console.log(data);
                        $('#list-users').html(data);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
                // event.preventDefault();
            }
        });
    });



</script>
</body>
</html>
