<div class="pre-share-wrapper">
    <div class="pre-share-info">
        <div class="pre-share-name">
            <h5>Tên gói premium</h5>
        </div>

        <div class="pre-share-start">
            <h5>Ngày bắt đầu</h5>
        </div>

        <div class="pre-share-end">
            <h5>Ngày kết thúc</h5>
        </div>

        <div class="pre-share-quantity">
            <h5>Số lượng người được share</h5>
        </div>
    </div>

    @for ($i = 0; $i < 5; $i++)
        @component('premium.premiumShareItem')
        @endcomponent
    @endfor
</div>
