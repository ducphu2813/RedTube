<div class="modal-invate-premium">
    <div class="modal-invate-container">
        <h4>Cùng xem, cùng vui với Premium</h4>
        <div class="modal-invate-input">
            <input type="text" class="modal-invate-text" placeholder="Nhập tên người dùng muốn chia sẻ">
            <div class="feedback">Có tồn tại không ?</div>
        </div>
        <button class="modal-invate-btn">
            <i class="fa-solid fa-paper-plane"></i>
        </button>
    </div>
</div>

<script>
    $(document).click(function(event) {
        // Cái này click bất kì ngoài modal thì ẩn modal đi
        var target = $(event.target);
        if (!target.closest('.modal-invate-container').length && $('.modal-invate-premium').is(":visible")) {
            $('#modal').empty();
        }
        
    });
    // Xử lý khi click vào nút invite
    
    $('.modal-invate-btn').on('click', function(){
        $('.feedback').toggleClass('feedback-wrong');
    });


</script>
