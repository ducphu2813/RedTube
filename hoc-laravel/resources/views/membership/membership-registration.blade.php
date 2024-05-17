<div class="regis-membership-wrapper"></div>
<div class="regis-membership-container">
    <h4 class="regis-membership-name">
        Tên gói
    </h4>
    <h4 class="regis-membership-price">
        Giá
    </h4>
    <h4 class="regis-membership-dura">
        Thời hạn
    </h4>
    <h4 class="regis-membership-btn">
        Hủy
    </h4>
</div>


@for ($i = 0; $i < 5; $i++)
    <div class="regis-membership-container">
        <div class="regis-membership-name">
            Gói membership 1
        </div>
        <div class="regis-membership-price">
            100000
        </div>
        <div class="regis-membership-dura">
            3 tháng
        </div>
        <div class="regis-membership-btn">
            <button class="btn btn-danger">Hủy</button>
        </div>
    </div>
@endfor

</div>

<script>
    // Xử lý khi click vào nút hủy
    $('.regis-membership-btn').click(function() {
        if (confirm('Bạn có chắc chắn muốn hủy gói membership này không?') == true) {
            // Xử lý hủy gói membership
            if($(this).children().hasClass('btn-danger')) {
                $(this).children().removeClass('btn-danger');
                $(this).children().addClass('btn-success');
                $(this).children().text('Đăng ký');
            }
            // Xử lý đăng ký gói membership (nếu cần)
            else{
                $(this).children().removeClass('btn-success');
                $(this).children().addClass('btn-danger');
                $(this).children().text('Hủy');
            }
        }
    });
</script>
