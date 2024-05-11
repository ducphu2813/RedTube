<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chia sẻ premium</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

    <div>
        <h2>Danh sách những người bạn chia sẻ premium</h2>

        <div id="list-shared">

        </div>
    </div>


    <h2>Chia sẻ gói premium của bạn cho người khác</h2>

    <input id="search-bar" type="text" placeholder="Tìm user muốn chia sẻ">

    <div id="list-users">

    </div>

    <script>
        $(document).ready(function(){

            // event cho thanh search
            $('#search-bar').on('keyup', function(event){
                if(event.keyCode === 13){
                    // event.preventDefault();

                    var searchValue = $(this).val();
                    $.ajax({
                        url: '{{ route('premium.search-user') }}',
                        method: 'GET',
                        data: {
                            name: searchValue
                        },
                        success: function(response){
                            console.log(response);
                            var listUsers = response.data;
                            var registrationId = response.current_user_premium.registration_id;
                            var html = '';
                            listUsers.forEach(function(user){
                                if(user.user_id !== {{ session('loggedInUser') }}){
                                    html += '<div>';
                                    html += '<h4>' + user.user_id + '</h4>';
                                    html += '<h4>' + user.user_name + '</h4>';
                                    if(user.isSendable === false){
                                        html += '<h4>' + 'Bạn đã chia sẻ rồi, hãy đợi 1 ngày sau' + '</h4>';
                                    }
                                    else{
                                        html += '<button data-registration-id="' + registrationId + '" data-user-id="' + user.user_id + '">Chia sẻ</button>';
                                    }
                                    html += '</div>';
                                }

                            });

                            $('#list-users').html(html);

                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }


            });


            //event cho button chia sẻ
            $(document).on('click', 'button[data-user-id]', function() {
                var userId = $(this).data('user-id');
                var button = $(this);

                $.ajax({
                    url: '{{ route('premium.handle-send') }}', // Replace with your share URL
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        sender_id: {{ session('loggedInUser') }},
                        receiver_id: userId,
                        registration_id: $(this).data('registration-id')
                    },
                    success: function(response) {
                        // Handle success response
                        console.log(response);
                        if(response.status === 200){
                            button.text('Đã chia sẻ');
                            button.prop('disabled', true);
                        }
                        else{

                        }
                    },
                    error: function(error) {
                        // Handle error response
                        console.log(error);
                    }
                });
            });

        });

    </script>
</body>
</html>
