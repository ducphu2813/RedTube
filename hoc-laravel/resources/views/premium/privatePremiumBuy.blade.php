@section('styles')
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
@endsection

<div class="premium-modal">
    <div class="premium-modal-color">

        <div class="premium-content">
            <div class="premium-logo margin-item">
                <img src="https://www.gstatic.com/youtube/img/promos/growth/ytp_lp2_logo_phone_portrait_300x80.png"
                    alt="">
            </div>

            <div class="premium-intro margin-item">
                Thưởng thức trọn vẹn YouTube mà không bị gián đoạn.
            </div>

            <div class="premium-description margin-item">
                Trải nghiệm YouTube và YouTube Music không quảng cáo, không cần mạng, và phát trong nền.
            </div>

            <a class="premium-buy-to-form premium-buy margin-item" href="#buyform">
                Dùng ngay chỉ với 4000đ/ngày
            </a>

            <div class="premium-intro margin-item" style="padding: 0 100px;">
                Chọn gói Premium phù hợp với bạn
            </div>

            <div class="premium-buy-list margin-item" id="buyform">

                @foreach($premiums as $premium)
                    <div class="premium-buy-item margin-item">
                        <div class="premium-buy-title">
                            {{ $premium->name }}
                        </div>
                        <div class="premium-buy-info">
                            <div class="premium-price margin-item">
                                Giá chỉ: {{ $premium->price }}đ
                            </div>
                            <div class="premium-price margin-item">
                                Thời hạn: {{ $premium->duration/30 }} tháng
                            </div>
                            <div class="premium-buy-btn">
                                <a href="" class="premium-buy" flag="premium" pack_id="{{ $premium->package_id }}">Mua ngay</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <div class="premium-intro margin-item">
                Tiếp tục phát nội dung yêu thích — không gián đoạn.
            </div>

            <div class="premium-intro-info margin-item">
                <div class="premium-intro-info-text margin-item">
                    <h1>Video không QC, không giới hạn</h1>
                    Xem thêm nhiều video yêu thích mà không phải chờ hết quảng cáo. Tìm video hướng dẫn, thử
                    công thức nấu ăn mới hoặc tập thể dục khi xem các nhà sáng tạo bạn yêu thích, hoàn toàn
                    không bị gián đoạn.
                </div>

                <div class="premium-intro-info-video margin-item">
                    <img src="https://www.gstatic.com/youtube/img/promos/growth/premium_lp2_large_feature_AdFree_dark_tablet_632x455.webp"
                        alt="">
                </div>
            </div>

            <div class="premium-intro-info margin-item">
                <div class="premium-intro-info-video margin-item">
                    <img src="https://www.gstatic.com/youtube/img/promos/growth/premium_lp2_large_feature_UnlimitedDownloads_dark_tablet_632x615.webp"
                        alt="">
                </div>

                <div class="premium-intro-info-text margin-item">
                    <h1>Chia sẻ với gia đình</h1>
                    Xem mọi lúc mọi nơi, cùng mọi người, tận hưởng ấm áp từ việc chia sẻ premium.
                </div>
            </div>

            <div class="premium-question-container margin-item">
                <div class="premium-question-title margin-item premium-intro">
                    Giải đáp các câu hỏi của bạn
                </div>

                <div class="premium-question-item">
                    <div class="premium-question-up">
                        <div class="premium-question-text">
                            Gói YouTube Premium có những gì?
                        </div>
                        <div class="premium-question-btn">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>

                    <div class="premium-question-answer">
                        Khi là thành viên YouTube Premium, bạn có thể xem video không có quảng cáo trên YouTube.
                        Hơn nữa, bạn có thể tải video xuống để xem không cần mạng và phát video trong nền khi
                        dùng các ứng dụng khác.
                        Gói thành viên YouTube Premium bao gồm cả quyền sử dụng YouTube Music Premium. Hãy tải
                        ứng dụng YouTube Music xuống để nghe hơn 100 triệu bài hát không có quảng cáo, không cần
                        mạng và khi khoá màn hình.
                        Bạn cũng có thể xem video không có quảng cáo trên ứng dụng YouTube Kids.
                    </div>
                </div>

                <div class="premium-question-item">
                    <div class="premium-question-up">
                        <div class="premium-question-text">
                            Làm cách nào để thêm người khác vào gói của tôi?
                        </div>
                        <div class="premium-question-btn">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </div>

                    <div class="premium-question-answer">
                        Bạn có thể mua gói thành viên YouTube Premium dành cho gia đình để chia sẻ với tối đa 5
                        thành viên khác trong gói gia đình. Khi mua gói dành cho gia đình, bạn có thể thêm thành
                        viên nếu bạn là người quản lý gia đình. Các thành viên gia đình dùng chung gói dành
                        cho gia đình phải sống trong cùng hộ gia đình với người quản lý gia đình và
                        có Tài khoản Google. Mỗi thành viên gia đình sẽ có tài khoản riêng tư và được cá nhân
                        hoá.
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

{{-- Script mua ở này --}}
<script>
    $(document).ready(function() {

        $('.premium-buy-to-form').click(function() {
            $('html, body').animate({
                scrollTop: $("#buyform").offset().top
            }, 2000);
        });

        //event cho nút mua
        $('.premium-buy').click(function(event) {
            event.preventDefault();

            var pack_id = $(this).attr('pack_id');
            var flag = $(this).attr('flag');
            $.ajax({
                url: '{{ route('buyPackage') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    pack_id: pack_id,
                    flag: flag
                },
                success: function(data) {
                    console.log(data);
                    window.location.href = '/payment-page';
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });
    });
</script>
