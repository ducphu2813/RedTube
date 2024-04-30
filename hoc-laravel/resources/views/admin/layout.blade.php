<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div id="wrap">
        <div id="leftmenu" class="">
            <div class="logo">
                <a href=""><img src="{{ asset('resources/img/youtube.svg') }}" alt="BinaryBook" /></a>
            </div>
            <ul>
                <li>
                    <img src="{{ asset('resources/img/video.svg') }}" /><a href="">Video</a>
                </li>
                <li>
                    <img src="{{ asset('resources/img/user.svg') }}" /><a href="">Người dùng</a>
                </li>
                <li>
                    <img src="{{ asset('resources/img/chat.svg') }}" /><a href="">Bình luận</a>
                </li>
                <li>
                    <img src="{{ asset('resources/img/videotest.svg') }}" /><a href="">Kiểm duyệt</a>
                </li>
                <li>
                    <img src="{{ asset('resources/img/analytics.svg') }}" /><a href="">Thống kê</a>
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

            </div>
        </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="admin.js"></script>
        <script>
            $(document).ready(function() {
                $('#leftmenu li').on('click', function() {
                    var index = $(this).index();
                    if (index == 0) {
                        $.ajax({
                            url: '{{ route('admin.videoManager') }}',
                            type: 'GET',
                            dataType: 'html',
                            success: function(data) {
                                $('#leftsection').html(data);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                        event.preventDefault();
                    } else if (index == 1) {
                        $.ajax({
                            url: '{{ route('admin.userManager') }}',
                            type: 'GET',
                            dataType: 'html',
                            success: function(data) {
                                $('#leftsection').html(data);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                        event.preventDefault();
                    } else if (index == 2) {
                        $.ajax({
                            url: '{{ route('admin.commentManager') }}',
                            type: 'GET',
                            dataType: 'html',
                            success: function(data) {
                                $('#leftsection').html(data);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                        event.preventDefault();
                    } else if (index == 3) {
                        $.ajax({
                            url: '{{ route('admin.checkManager') }}',
                            type: 'GET',
                            dataType: 'html',
                            success: function(data) {
                                $('#leftsection').html(data);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                        event.preventDefault();
                    } else if (index == 4) {
                        $.ajax({
                            url: '{{ route('admin.chartManager') }}',
                            type: 'GET',
                            dataType: 'html',
                            success: function(data) {
                                $('#leftsection').html(data);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                        event.preventDefault();
                    }
                });
            });
        </script>
</body>

</html>
