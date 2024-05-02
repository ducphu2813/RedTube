<!-- Dùng modal.css -->
<div class="modal-pl">
    <div class="modal-info-wrapper">
        <div id="modal-info-header">
            <h4>Tạo gói thành viên mới</h4>
        </div>

        <div id="modal-info-content">
            <div class="modal-info-content--item">
                <label for="modal-name">Tên gói thành viên</label>
                <input type="text" name="modal-name" id="modal-name" placeholder="Tên gói thành viên">
            </div>

            <div class="modal-info-content--item">
                <label for="modal-description">Mô tả</label>
                <textarea name="modal-description" id="modal-description" placeholder="Mô tả""></textarea>
            </div>

            <div class="wrap-data">
                <div class="modal-info-content--item modal-fee">
                    <label for="modal-name">Phí thành viên</label>
                    <input type="text" name="modal-name" id="modal-name" placeholder="Phí thành viên">
                </div>
                <div class="modal-info-content--item modal-duration">
                    <label for="modal-name">Thời hạn gói</label>
                    <div class="wrap-value">
                        <input type="text" name="modal-name" id="modal-name" placeholder="Thời hạn gói">
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
</script>
