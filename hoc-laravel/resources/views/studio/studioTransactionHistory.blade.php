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
            Người thanh toán
        </div>

        <div class="item__buyDate">
            Ngày mua
        </div>

        <div class="item__totals">
            Tổng tiền
        </div>
    </li>

        @foreach($payments as $payment)
            <li class="content__body--item">
                <div class="item__optionbox">
                    <button class="item__optionbox--btn edit--btn">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                </div>
                <input type="hidden" value="{{ $payment->payment_id }}">

                <div class="item__content">
                    {{$payment->full_name}}
                </div>

                <div class="item__buyDate">
                    {{ $payment->payment_date }}
                </div>

                <div class="item__totals">
                    {{ $payment->amount }} &dstrok;
                </div>
            </li>
        @endforeach
</div>

<script>
    $('.edit--btn').on('click', function(event) {
        var payment_id = $(this).parent().next().val();
        $.ajax({
            url: '{{ route('studio.transactionDetails') }}',
            type: 'POST',
            dataType: 'json',
            data: {
                payment_id: payment_id,
                _token: '{{ csrf_token() }}'
            },
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
