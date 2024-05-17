<link rel="stylesheet" href="{{ asset('css/studio/studioTransactionHistory.css') }}">

<div class="content__title">Lịch sử giao dịch</div>

<!-- body -->
<div class="content__body" id="body">
    <ul class="content__body--list">

    <!-- header -->
    <li class="content__body--item list--header" style="font-weight: 700;">
        <div class="item__optionbox">

        </div>

        <div class="item__content">
            Tên sản phẩm
        </div>

        <div class="item__buyDate">
            Ngày mua
        </div>

        <div class="item__totals">
            Tổng tiền
        </div>
    </li>

        <li class="content__body--item">
            <div class="item__optionbox">
                <button class="item__optionbox--btn edit--btn">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
            </div>

            <div class="item__content">
                Gói premium siêu provip
            </div>

            <div class="item__buyDate">
                2024-05-07 12:00:00
            </div>

            <div class="item__totals">
                120000 &dstrok;
            </div>
        </li>
</div>

<script>
    $('.edit--btn').on('click', function(event) {
        $.ajax({
            url: '{{ route('studio.transactionDetails') }}',
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                $('#modal').html(data)
            },
            error: function(xhr, status, error) {
                console.error('Error fetching content:', error);
            }
        });
        event.preventDefault();
    });
</script>
