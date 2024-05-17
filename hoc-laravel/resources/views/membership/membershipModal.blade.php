<!-- Dùng modal.css -->
<div class="modal-pl">
    <div class="modal-info-wrapper">
        <div id="modal-info-header">
            <h4>Tạo gói thành viên mới</h4>
        </div>

        <div id="modal-info-content">
            <div class="modal-info-content--item">
                <label for="modal-name">Tên gói thành viên</label>
                <input type="text" name="modal-name" id="modal-name" placeholder="Tên gói thành viên" required>
            </div>

            <div class="modal-info-content--item">
                <label for="modal-description">Mô tả</label>
                <textarea name="modal-description" id="modal-description" placeholder="Mô tả" required></textarea>
            </div>

            <div class="wrap-data">
                <div class="modal-info-content--item modal-fee">
                    <label for="modal-name">Phí thành viên</label>
                    <input type="number" name="modal-name" id="modal-name" placeholder="Phí thành viên" required>
                </div>
                <div class="modal-info-content--item modal-duration">
                    <label for="modal-name">Thời hạn gói</label>
                    <div class="wrap-value">
                        <input type="number" name="modal-name" id="modal-name" placeholder="Thời hạn gói">
                        <span>tháng</span>
                    </div>

                </div>
            </div>
        </div>


        <div id="modal-info-btn">
            <button class="modal-btn" id="modal-info-btn--cancel">Hủy</button>
            <button class="modal-btn" id="modal-info-btn--create">Tạo</button>
        </div>
    </div>
</div>

<script>
    var modalPl = document.querySelector('.modal-pl');
    var modalInfoBtnCreate = document.getElementById('modal-info-btn--create');

    modalInfoBtnCreate.addEventListener('click', function() {

    });

    //event tạo gói thành viên
    $('#modal-info-btn--create').click(function() {
        var name = $('#modal-name').val();
        var description = $('#modal-description').val();
        var fee = $('.modal-fee input').val();
        var duration = $('.modal-duration input').val();

        //validation
        if (name == '' || description == '' || fee == '' || duration == '') {
            alert('Vui lòng nhập đầy đủ thông tin');
            return;
        }else{
            if (fee < 0 || duration < 0) {
                alert('Vui lòng nhập số lớn hơn 0');
                return;
            }
            else if (duration > 12) {
                alert('Thời hạn không được lớn hơn 1 năm');
                return;
            }
        }

        $.ajax({
            url: '{{ route('membership.createMemberPackage') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                name: name,
                description: description,
                price: fee,
                duration: duration*30
            },
            success: function(data) {
                alert(data.message);
                console.log(data);
                $('#modal').empty();
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
</script>
