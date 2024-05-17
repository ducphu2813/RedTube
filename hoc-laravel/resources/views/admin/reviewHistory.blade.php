<link rel="stylesheet" href="{{ asset('css/reviewHistory.css') }}">
<div class="review-all-header">Lịch sử duyệt</div>
<div class="review-all-wrapper">
    <div class="review-all-item">
        <div class="review-all-avt">
            <h4>Tài khoản</h4>
        </div>
        <div class="review-all-info">
            <h4>Nội dung duyệt</h4>
        </div>
        <div class="review-all-thumb">
            <h4>Video</h4>
        </div>
    </div>

    @foreach ($reviewList as $rv)
        <div class="review-all-item" id=" {{ $rv->review_id }} ">
            <div class="review-all-avt">
                <img src="{{ $rv->video->user->picture_url }}" alt="">
                <div>{{ $rv->video->user->user_name }}</div>
            </div>
            <div class="review-all-info">
                Video: {{ $rv->video->title }} <br>
                {!! $rv->review_status == 1 ? 'Đã duyệt vào lúc ' . $rv->review_time : 'Lý do: ' . $rv->note . ' ' . $rv->review_time!!}
            </div>
            <div class="review-all-thumb">
                <img src="{{ $rv->video->thumbnail_path }}" alt="">
            </div>
        </div>
    @endforeach
</div>
