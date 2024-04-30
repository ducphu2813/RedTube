{{-- Modal này để dùng cho add và edit --}}
<!-- Dùng modal.css -->
<div class="modal-pl">
    <div class="modal-info-wrapper">
        <div id="modal-info-header">
            <h4>Tạo danh sách phát mới</h4>
        </div>

        <div id="modal-info-content">
            <div class="modal-info-content--item">
                <label for="modal-name">Tên danh sách phát</label>
                <input type="text" name="modal-name" id="modal-name" placeholder="Thêm tiêu đề">
            </div>

            <div class="modal-info-content--item">
                <label for="modal-description">Mô tả</label>
                <textarea name="modal-description" id="modal-description" placeholder="Thêm mô tả"></textarea>
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
    var modalInfoBtnCancel = document.getElementById('modal-info-btn--cancel');
    var modalInfoBtnCreate = document.getElementById('modal-info-btn--create');

    // modalInfoBtnCancel.addEventListener('click', function(){
        

    // });

    modalInfoBtnCreate.addEventListener('click', function() {
        console.log('Cancel');
    });
</script>