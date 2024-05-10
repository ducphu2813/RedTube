<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
    user : {{ session('loggedInUser') }}
    <h2>Các lời mời chia sẻ gói premium</h2>

    <div id="list-noti">

    </div>

    <script>
        $(document).ready(function(){
            $.ajax({
                url: '{{ route('premium.get-noti') }}',
                method: 'GET',
                success: function(response){
                    console.log(response);
                    var noti = response.data;
                    var html = '';
                    noti.forEach(function(noti){
                        html += '<div>';
                        html += '<h4>' + noti.sender.user_id + '</h4>';
                        html += '<h4>' + noti.sender.user_name + '</h4>';
                        html += '<button class="accept" data-noti-id="' + noti.noti_id + '">Chấp nhận</button>';
                        html += '<button class="reject" data-noti-id="' + noti.noti_id + '">Từ chối</button>';
                        html += '</div>';
                    });

                    $('#list-noti').html(html);

                    $('.accept').on('click', function() {
                        var notiId = $(this).data('noti-id');
                        // xử lý chấp nhận yêu cầu


                        console.log('Accepted: ' + notiId);
                    });

                    $('.reject').on('click', function() {
                        var notiId = $(this).data('noti-id');
                        // Xử lý từ chối
                        console.log('Rejected: ' + notiId);
                    });
                },
                error: function(error){
                    console.log(error);
                }
            });
        });

    </script>
</body>
</html>
