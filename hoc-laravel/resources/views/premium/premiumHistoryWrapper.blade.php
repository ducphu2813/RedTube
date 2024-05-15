<div class="my-premium-wrapper">

    <div class="my-premium-info" href="">
        <div class="my-premium-user-name">
            <h5>Tên người chia sẻ</h5>
        </div>

        <div class="my-premium-name">
            <h5>Tên gói premium</h5>
        </div>

        <div class="my-premium-start">
            <h5>Ngày bắt đầu</h5>
        </div>

        <div class="my-premium-end">
            <h5>Ngày kết thúc</h5>
        </div>

        <div class="pre-share-quantity">
            <h5>Hủy</h5>
        </div>
    </div>

    {{-- Chổ này đổ data của premium được người khác chia sẻ --}}
    @if($all_shared_premium->count() > 0)
        @foreach($all_shared_premium as $shared_premium)
            @component('premium.premiumHistoryItem', ['shared_premium' => $shared_premium])
            @endcomponent
        @endforeach
    @endif


{{--    @for ($i = 0; $i < 5; $i++)--}}
{{--        @component('premium.premiumHistoryItem')--}}
{{--        @endcomponent--}}
{{--    @endfor--}}
</div>
