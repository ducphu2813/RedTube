<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div id="wrap">
        <div id="leftmenu" class="">
            <div class="logo">
                <a href=""><img src="./assets/img/youtube.svg" alt="BinaryBook" /></a>
            </div>
            <ul>
                <li>
                    <img src="./assets/img/video.svg" /><a href="{{ route('') }}">Video</a>
                </li>
                <li>
                    <img src="./assets/img/user.svg" /><a href="./pages/userItem.php">Người dùng</a>
                </li>
                <li>
                    <img src="./assets/img/chat.svg" /><a href="">Bình luận</a>
                </li>
                <li>
                    <img src="./assets/img/videotest.svg" /><a href="">Kiểm duyệt</a>
                </li>
                <li>
                    <img src="./assets/img/analytics.svg" /><a href="">Thống kê</a>
                </li>
            </ul>
        </div>

        <div id="content">
            <div id="rightsection">
                <div class="group-search">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                        <g>
                            <path
                                d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z">
                            </path>
                        </g>
                    </svg>
                    <input placeholder="Search" type="search" class="input">
                </div>

                <div class="group-filter">
                    <select class="select">

                    </select>
                </div>


            </div>
            <div id="leftsection">
                <canvas id="myChart1" style="width:100%;max-width:100%;"></canvas>
            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="admin.js"></script>
        <script>
            $(document).ready(function() {
                        $.ajax({
                            url: '{{ route('admin.abc') }}',
                            type: 'GET',
                            dataType: 'html',
                            success: function(data) {
                                $('#leftsection').append(data);
                                console.log(data);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    });
        </script>
</body>

</html>
