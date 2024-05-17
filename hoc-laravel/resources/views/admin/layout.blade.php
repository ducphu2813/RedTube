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
                <li class="" flag="video">
                    <img src="{{ asset('resources/img/video.svg') }}" />
                    <a href="{{ route('admin.videoManager') }}">Video</a>
                </li>
                <li class="" flag="user">
                    <img src="{{ asset('resources/img/user.svg') }}" />
                    <a href="{{ route('admin.userManager') }}">Người dùng</a>
                </li>
                <li class="">
                    <img src="{{ asset('resources/img/videotest.svg') }}" />
                    <a href="{{ route('admin.checkManager') }}">Kiểm duyệt</a>
                </li>
                <li class="">
                    <img src="{{ asset('resources/img/history.svg') }}" />
                    <a href="{{ route('admin.reviewHistoryListManager') }}">Lịch sử duyệt</a>
                </li>
                <li class="">
                    <img src="{{ asset('resources/img/analytics.svg') }}" />
                    <a href="{{ route('admin.showChart') }}">Thống kê</a>
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
                    <input placeholder="Search" type="search" class="input" id="searchbar">
                </div>

            </div>
            <div id="leftsection">

            </div>
        </div>

        <div id="admin-modal">

        </div>
</body>

</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
{{-- <script src="admin.js"></script> --}}
<script>
    $(document).ready(function() {
        $('#leftmenu li').on('click', function() {
            event.preventDefault();
            var link = $(this).find('a').attr('href');
            $(this).addClass('highlight');
            $(this).siblings().removeClass('highlight');
            // var flag = $(this).attr('flag');
            if($(this).attr('flag') === 'video' || $(this).attr('flag') === 'user'){
                $('#rightsection').css('display', 'flex');
            } else {
                $('#rightsection').css('display', 'none');
            }
            console.log(link);
            $.ajax({
                url: link,
                type: 'GET',
                dataType: 'html',

                success: function(data) {
                    $('#leftsection').html(data);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });

    // gọi lại sự kiện user sau khi cập nhật nội dung HTML
    function bindItemUserBtnChange() {
            $('.item-container').on('change', '#user-role', function() {
                var role = $(this).val();
                var id = $(this).parent().parent().attr('id');
                // console.log(role);
                // console.log(id);
                $.ajax({
                    url: "{{ route('admin.changeRoleUser') }}",
                    type: 'POST',
                    data: {
                        user_id: id,
                        role: role,
                        _token: "{{ csrf_token() }}"
                    },
                    cache: false,
                    success: function(response) {
                        console.log("Thành công");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });

            $('.item-container').on('change', '.item-btn', function() {
                var status;
                var id = $(this).parent().attr('id');
                if ($(this).find('input').is(":checked")) {
                    if (confirm("Bạn có muốn khóa tài khoản?")) {
                        status = 0;
                    } else {
                        $(this).find('input').prop('checked', false);
                    }
                } else {
                    if (confirm("Bạn có muốn mở khóa tài khoản?")) {
                        status = 1;
                    } else {
                        $(this).find('input').prop('checked', true);
                    }
                }
                console.log(status);
                console.log(id);
                $.ajax({
                    url: "{{ route('admin.changeStatusUser') }}",
                    type: 'POST',
                    data: {
                        user_id: id,
                        active: status,
                        _token: "{{ csrf_token() }}"
                    },
                    cache: false,
                    success: function(response) {
                        alert("Thay đổi trạng thái");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });
        }

    // gọi lại sự kiện sau khi cập nhật nội dung HTML
    function bindItemBtnChange() {
        $('.item-container').on('change', '.item-btn', function() {
            var status;
            var id = $(this).parent().attr('id');
            if ($(this).find('input').is(":checked")) {
                if (confirm("Bạn có muốn khóa Video?")) {
                    status = 0;
                } else {
                    $(this).find('input').prop('checked', false);
                }
            } else {
                if (confirm("Bạn có muốn mở khóa Video?")) {
                    status = 1;
                } else {
                    $(this).find('input').prop('checked', true);
                }
            }
            console.log(status);
            console.log(id);
            $.ajax({
                url: "{{ route('admin.changeStatusVideo') }}",
                method: 'POST',
                data: {
                    video_id: id,
                    is_approved: status,
                    _token: "{{ csrf_token() }}"
                },
                cache: false,
                success: function(response) {
                    alert("Thay đổi trạng thái");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });
    }

    bindItemBtnChange();

    // Tìm kiếm
    $('#searchbar').on('keydown', function(e) {
        if (e.which == 13) {
            var search = $(this).val();
            var cate = [];
            $('.video-category-item-clicked').each(function() {
                cate.push($(this).attr('id'));
            });
            var status = $('input[type=radio][name=isapproved]:checked').val();
            console.log(search);
            var flag = $('#leftmenu li.highlight').attr('flag');
            if (flag == 'video') {
                var cate = [];
                $('.video-category-item-clicked').each(function() {
                    cate.push($(this).attr('id'));
                });
                var status = $('input[type=radio][name=isapproved]:checked').val();
                // var url = $(this).attr('route');
                // console.log(url);
                $.ajax({
                    url: "{{ route('admin.filterVideo') }}",
                    method: 'POST',
                    data: {
                        is_approved: status,
                        category_ids: cate,
                        keyword: search,
                        _token: "{{ csrf_token() }}"
                    },
                    cache: false,
                    success: function(response) {
                        $('#videoWrapper').html(response);
                        // console.log(response.videos);
                        // console.log(response);
                        bindItemBtnChange(); // Gán lại sự kiện sau khi cập nhật nội dung HTML
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            } else if (flag == 'user') {
                var lock = $('input[type=radio][name=islock]:checked').val();
                var role = $('input[type=radio][name=role]:checked').val();
                console.log(lock);
                console.log(role);
                $.ajax({
                    url: "{{ route('admin.filterUser') }}",
                    method: 'POST',
                    data: {
                        is_active: lock,
                        role: role,
                        keyword: search,
                        _token: "{{ csrf_token() }}"
                    },
                    cache: false,
                    success: function(response) {
                        $('#userWrapper').html(response);
                        // console.log(response.videos);
                        // console.log(response);
                        if (response == "") {
                            $('#userWrapper').html("<h1 style='text-align: center;margin-top:100px;'>Không có dữ liệu</h1>");
                        }
                        bindItemUserBtnChange(); // Gán lại sự kiện sau khi cập nhật nội dung HTML
                    },
                    error: function(response) {
                        console.log(response);
                    }
                });
            } else {
                // $('#rightsection').css('display', 'none');
            }
        }

    });
</script>
