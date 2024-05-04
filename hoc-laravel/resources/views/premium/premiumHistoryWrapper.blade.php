<div class="my-premium-wrapper">

    <div class="my-premium-info" href="">
        <div class="my-premium-name">
            <h5>Tên gói premium</h5>
        </div>

        <div class="my-premium-start">
            <h5>Ngày bắt đầu</h5>
        </div>

        <div class="my-premium-end">
            <h5>Ngày kết thúc</h5>
        </div>
    </div>

    @foreach ($listRegistrations as $registration)
        @component('premium.premiumHistoryItem', ['registration' => $registration])
        @endcomponent
    @endforeach
</div>
