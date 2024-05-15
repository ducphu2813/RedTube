<div class="regis-membership-wrapper"></div>
<div class="regis-membership-container">
    <h4 class="regis-membership-name">
        Kênh
    </h4>
    <h4 class="regis-membership-name">
        Tên gói
    </h4>
    <h4 class="regis-membership-price">
        Ngày mua
    </h4>
    <h4 class="regis-membership-dura">
        Hết hạn
    </h4>
    <h4 class="regis-membership-btn">
        Hủy
    </h4>
</div>

@foreach($listMembershipRegistered as $membershipRegistered)
    <div class="regis-membership-container">
        <div class="regis-membership-name">
            {{ $membershipRegistered->user->channel_name }}
        </div>
        <div class="regis-membership-name">
            {{ $membershipRegistered->membership ? $membershipRegistered->membership->name : 'N/A' }}
        </div>
        <div class="regis-membership-price">
            {{ $membershipRegistered->start_date }}
        </div>
        <div class="regis-membership-dura">
            {{ $membershipRegistered->end_date }}
        </div>
        @if($membershipRegistered->end_date < date('Y-m-d H:i:s'))
            <div class="regis-membership-btn">
                Hết hiệu lực
            </div>
        @else
            <div class="regis-membership-btn" mbs_id="{{ $membershipRegistered->subscription_id }}">
                <button class="btn btn-danger" >Hủy</button>
            </div>
        @endif

    </div>
@endforeach

</div>

<script>
    // Xử lý khi click vào nút hủy
    $('.regis-membership-btn').click(function() {

        if($(this).children().hasClass('btn-danger')) {
            if (confirm('Bạn có chắc chắn muốn hủy gói membership này không?') === true) {
                // Xử lý hủy gói membership

                var id = $(this).attr('mbs_id');
                $.ajax({
                    url: '{{ route('membership.cancelMemberPackage') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                    },
                    error: function (data) {
                        console.log(data);
                    }
                })


            }
        }
    });
</script>
