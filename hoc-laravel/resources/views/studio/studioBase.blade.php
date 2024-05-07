@extends('main.homePageLayout')
@section('title', 'Studio')
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/studio.css') }}">
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">
@endsection

@section('search')
    <div id="top">
        <div class="logo">
            <img src="https://www.gstatic.com/youtube/img/creator/yt_studio_logo_white.svg" alt="">
        </div>

        <div class="search-container ">
            <input type="text" name="search-bar" id="" class="search-bar" placeholder="Tìm kiếm">
            <button type="submit">
                <i class="fa-solid fa-magnifying-glass" style="color: #fff; font-size: 14px;"></i>
            </button>
        </div>

        <div class="add-btn">
            <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false"
                class="style-scope tp-yt-iron-icon"
                style="pointer-events: none; display: block; width: 100%; height: 100%;">
                <g class="style-scope tp-yt-iron-icon">
                    <path
                        d="M14,13h-3v3H9v-3H6v-2h3V8h2v3h3V13z M17,6H3v12h14v-6.39l4,1.83V8.56l-4,1.83V6 M18,5v3.83L22,7v8l-4-1.83V19H2V5H18L18,5 z"
                        class="style-scope tp-yt-iron-icon"></path>
                </g>
            </svg>
            <p>TẠO</p>
            <ul id="create-list">
                <li class="create-item"><a href="#">Video</a></li>
                <li class="create-item"><a href="#">Danh sách phát</a></li>
                <li class="create-item"><a href="#">Gói thành viên</a></li>
            </ul>
        </div>

        <div class="acc-box ">
            <img src="{{ asset('resources/img/user.png') }}" alt="XXX">
        </div>
    </div>
@endsection

@section('nav')
    <div id="left">

        <div class="account-box">
            <div class="account-box-avatar">
                <img src="{{ asset('resources/img/ocean.jpg') }}" alt="XXX">
            </div>
            <div class="account-box-name">UserChannel</div>
        </div>

        <ul class="list-container">
            <li class="list-item" data-url="{{ route('studio.contents') }}">
                <a href="">
                    <span class="list-icon">
                        <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false"
                            class="style-scope tp-yt-iron-icon"
                            style="pointer-events: none; display: block; width: 100%; height: 100%;">
                            <g width="24" height="24" viewBox="0 0 24 24" class="style-scope tp-yt-iron-icon">
                                <path d="M4 5.99982H3V20.9998H18V19.9998H4V5.99982Z" class="style-scope tp-yt-iron-icon">
                                </path>
                                <path d="M6 2.99982V17.9998H21V2.99982H6ZM11 13.9998V6.99982L17 10.4998L11 13.9998Z"
                                    class="style-scope tp-yt-iron-icon"></path>
                            </g>
                        </svg>
                    </span>
                    Nội dung
                </a>
            </li>
            <li class="list-item">
                <a href="">
                    <span class="list-icon">
                        <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false"
                            class="style-scope tp-yt-iron-icon"
                            style="pointer-events: none; display: block; width: 100%; height: 100%;">
                            <g width="24" height="24" viewBox="0 0 24 24" class="style-scope tp-yt-iron-icon">
                                <path
                                    d="M9 17H7V10H9V17ZM13 7H11V17H13V7ZM17 14H15V17H17V14ZM20 4H4V20H20V4ZM21 3V21H3V3H21Z"
                                    class="style-scope tp-yt-iron-icon"></path>
                            </g>
                        </svg>
                    </span>
                    Số liệu phân tích
                </a>
            </li>
            <li class="list-item" data-url="{{ route('studio.profile') }}">
                <a href="">
                    <span class="list-icon">
                        <svg viewBox="0 0 24 24" preserveAspectRatio="xMidYMid meet" focusable="false"
                            class="style-scope tp-yt-iron-icon"
                            style="pointer-events: none; display: block; width: 100%; height: 100%;">
                            <g width="24" height="24" viewBox="0 0 24 24" class="style-scope tp-yt-iron-icon">
                                <path
                                    d="M6.71 7.2L7.89 5.1L6.71 3L8.81 4.18L10.91 3L9.74 5.1L10.92 7.2L8.82 6.02L6.71 7.2ZM18.9 14.26L16.8 13.08L17.98 15.18L16.8 17.28L18.9 16.1L21 17.28L19.82 15.18L21 13.08L18.9 14.26ZM21 3L18.9 4.18L16.8 3L17.98 5.1L16.8 7.2L18.9 6.02L21 7.2L19.82 5.1L21 3ZM17.14 10.02L6.15 21L3 17.85L14 6.85L17.14 10.02ZM6.15 19.59L13.7 12.04L11.96 10.3L4.41 17.85L6.15 19.59Z"
                                    class="style-scope tp-yt-iron-icon"></path>
                            </g>
                        </svg>
                    </span>
                    Thông tin kênh
                </a>
            </li>
            <li class="list-item">
                <a href="">
                    <span class="list-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" height="24"
                            viewBox="0 0 24 24" width="24" focusable="false"
                            style="pointer-events: none; display: inherit; width: 100%; height: 100%;">
                            <path d="m10 8 6 4-6 4V8zm11-5v18H3V3h18zm-1 1H4v16h16V4z"></path>
                        </svg>
                    </span>
                    Gói thành viên
                </a>
            </li>
            <li class="list-item" data-url="{{ route('studio.premium') }}">
                <a href="">
                    <span class="list-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"
                            focusable="false" style="pointer-events: none; display: inherit; width: 100%; height: 100%;">
                            <path
                                d="M10 14.65v-5.3L15 12l-5 2.65zm7.77-4.33-1.2-.5L18 9.06c1.84-.96 2.53-3.23 1.56-5.06s-3.24-2.53-5.07-1.56L6 6.94c-1.29.68-2.07 2.04-2 3.49.07 1.42.93 2.67 2.22 3.25.03.01 1.2.5 1.2.5L6 14.93c-1.83.97-2.53 3.24-1.56 5.07.97 1.83 3.24 2.53 5.07 1.56l8.5-4.5c1.29-.68 2.06-2.04 1.99-3.49-.07-1.42-.94-2.68-2.23-3.25zm-.23 5.86-8.5 4.5c-1.34.71-3.01.2-3.72-1.14-.71-1.34-.2-3.01 1.14-3.72l2.04-1.08v-1.21l-.69-.28-1.11-.46c-.99-.41-1.65-1.35-1.7-2.41-.05-1.06.52-2.06 1.46-2.56l8.5-4.5c1.34-.71 3.01-.2 3.72 1.14.71 1.34.2 3.01-1.14 3.72L15.5 9.26v1.21l1.8.74c.99.41 1.65 1.35 1.7 2.41.05 1.06-.52 2.06-1.46 2.56z">
                            </path>
                        </svg>
                    </span>
                    Premium
                </a>
            </li>
        </ul>
    </div>
@endsection

@section('content')
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            // handle creator list
            $('.create-item').on('click', function(event) {
                var index = $(this).index();
                if (index == 0) {

                } else if (index == 1) {
                    $.ajax({
                        url: '{{ route('playlist.createPlaylist') }}',
                        type: 'GET',
                        dataType: 'html',
                        success: function(data) {
                            // Thêm dữ liệu vào #modal
                            $('#modal').html(data);

                            // Hiển thị .modal-pl
                            $('.modal-pl').css('display', 'flex');

                            // Thêm sự kiện click vào nút hủy
                            $('#modal-info-btn--cancel').on('click', function() {
                                // Xóa tất cả nội dung trong #modal
                                $('#modal').empty();

                                // Loại bỏ tất cả các sự kiện đã được gắn kết với .modal-pl
                                // $('.modal-pl').off();
                            });
                        }
                    });
                } else {
                    $.ajax({
                        url: '{{ route('membership.createMemberPackage') }}',
                        type: 'GET',
                        dataType: 'html',
                        success: function(data) {
                            $('#modal').html(data);
                            $('.modal-pl').css('display', 'flex');
                            // Thêm sự kiện click vào nút hủy
                            $('#modal-info-btn--cancel').on('click', function() {
                                // Xóa tất cả nội dung trong #modal
                                $('#modal').empty();

                                // Loại bỏ tất cả các sự kiện đã được gắn kết với .modal-pl
                                // $('.modal-pl').off();
                            });
                        }
                    })
                }

                event.preventDefault();
            });

            // handle left navigator
            $('.list-item').on('click', function(event) {
                var index = $(this).index();
                if (index == 0) {
                    $.ajax({
                        url: '{{ route('studio.contents') }}',
                        type: 'GET',
                        dataType: 'html',
                        success: function(data) {
                            $('#content').html(data);
                        }
                    });
                } else if (index == 1) {
                    $.ajax({
                        url: '{{ route('studio.profile') }}',
                        type: 'GET',
                        dataType: 'html',
                        success: function(data) {
                            $('#content').html(data);
                        }
                    });
                } else if (index == 2) {

                } else if (index == 3) {
                    $.ajax({
                        url: '{{ route('membership.membershipManager') }}',
                        type: 'GET',
                        dataType: 'html',
                        success: function(data) {
                            $('#content').html(data);
                        }
                    });
                } else {
                    $.ajax({
                        url: '{{ route('premium.premiumManager') }}',
                        type: 'GET',
                        dataType: 'html',
                        success: function(data) {
                            $('#content').html(data);
                        }
                    });

                }

                $('#content').empty()
                event.preventDefault();
            });
        });
    </script>
@endsection
