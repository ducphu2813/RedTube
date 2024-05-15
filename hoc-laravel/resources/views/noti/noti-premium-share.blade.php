<div class="noti-wrapper">
    <div class="noti-content">
        <div class="noti-avt">
            <img src="{{ asset('resources/img/ocean.jpg') }}" alt="" srcset="">
        </div>

        <div class="noti-info">
            <div>
                {{ $notification['sender_name'] }} muốn chia sẻ premium với bạn
            </div>
            <div>
                Ngày gửi: {{ $notification['created_date'] }}
            </div>
        </div>

        @if(strtotime($notification['expiry_date']) > strtotime(date('Y-m-d H:i:s')))
            <div class="noti-btn">
                <div class="noti-btn-acp">
                    <button class="btn btn-success">Chấp nhận</button>
                </div>

                <div class="noti-btn-dec">
                    <button class="btn btn-danger">Từ chối</button>
                </div>
            </div>
        @else
            <div class="noti-expired">
                Đã hết hạn
            </div>
        @endif
    </div>
</div>
