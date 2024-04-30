@section('styles')
    <link rel="stylesheet" href="{{ asset('css/premium.css') }}">
@endsection

{{-- @section('content') --}}
    <div id="preimum-container">
        <div class="premium-title">
            <div class="premium-logo" style="background-color: transparent;">
                <img src="https://www.gstatic.com/youtube/img/promos/growth/ytp_lp2_logo_phone_landscape_300x44.png"
                    alt="">
            </div>
            Trải nghiệm YouTube không quảng cáo, chỉ với 4000đ/ngày với Youtube Premium.
        </div>
        <div id="premium-box">

            <div class="box">

                <div class="box-title">Premium 1 Tháng</div>
                <p>Không quảng cáo <br>
                    Chỉ với 129000đ/tháng</p>
                <button type="submit">Đăng ký ngay</button>
            </div>
            <div class="box">

                <div class="box-title">Premium 3 Tháng</div>
                <p>Không quảng cáo <br>
                    Chỉ với 349000đ/tháng</p>
                <button type="submit">Đăng ký ngay</button>
            </div>
            <div class="box">

                <div class="box-title">Premium 6 Tháng</div>
                <p>Không quảng cáo <br>
                    Chỉ với 699000đ/tháng</p>
                <button type="submit">Đăng ký ngay</button>
            </div>
        </div>
    </div>
{{-- @endsection --}}

{{-- @section('scripts')
    <script src="{{ asset('js/premium.js') }}"></script> --}}