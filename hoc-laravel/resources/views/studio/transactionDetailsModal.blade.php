<link rel="stylesheet" href="{{ asset('css/studio/transactionDetailsModal.css') }}">

<div id="modal__videoDetails" class="modal__popup">
    <div class="modal__overlay">
        <form action="" class="modal-form" method="post" enctype="multipart/form-data">
            <div class="form-section">
                <div class="form-top">Chi tiết giao dịch</div>
            </div>

            <div class="form-bottom">
                <div class="form-left">
                    <div class="form-group" style="display: none">
                        <label for="video_id">Id</label>
                        <input type="text" id="video_id" name="transaction_id" value="">
                    </div>

                    <div class="form-group">
                        <label for="username">Tên người dùng</label>
                        <input type="text" id="username" name="username" value="">
                    </div>

                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" id="address" name="address" value="">
                    </div>

                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" value="">
                    </div>
                </div>
        
                <div class="form-right">
                    <div class="form-info">
                        <span>Sản phẩm</span>
                        <div class="form-info-name">Gói premium siêu cấp provip</div>
                        <div class="form-info-info">
                            <div class="form-info-price">120000 &dstrok;</div>
                            <div class="form-info-duration">1 tháng</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="option">
                            <button class="close--btn" id="close--btn">Hủy</button>
                            <button class="save--btn" id="save--btn">Lưu</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $('#modal__transactionDetails').ready(function() {
            $('#close--btn').on('click', function(event) {
                $('#modal').empty();
                event.preventDefault();
            });
    
            $('#save--btn').on('click', function(event) {
            });
        });
    </script>
</div>