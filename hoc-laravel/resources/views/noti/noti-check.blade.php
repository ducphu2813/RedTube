<div class="noti-content">
    <div class="noti-avt">
        <img src="{{ asset('resources/img/ocean.jpg') }}" alt="" srcset="">
    </div>

    <div class="noti-info">
        <div>
            {{ $notification['message'] }} - {{ $notification['created_date'] }}
        </div>
        <div style="visible: hidden">
            Video: {{ $notification['video_title'] }}
        </div>
    </div>

    <div class="noti-thumbnail">
        <img src="{{ asset('resources/img/ocean.jpg') }}" alt="" srcset="">
    </div>
</div>
