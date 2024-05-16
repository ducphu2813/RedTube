<div class="modal-invate-premium">
    <div class="modal-invate-container">
        <h4>Cùng xem, cùng vui với Premium</h4>
        <div class="modal-invate-input">
            <input type="text" class="modal-invate-text" placeholder="Nhập tên người dùng muốn chia sẻ">
            <div class="feedback">Hãy nhập username của người bạn muốn share</div>
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

        $.ajax({
            url: '{{ route('premium.handle-send') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_name: $('.modal-invate-text').val()
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if(data.status === 400){
                    $('.feedback').text(data.message);
                    $('.feedback').toggleClass('feedback-wrong');
                    $('.feedback').style.color = 'red';
                }
                else{
                    $('.feedback').text(data.message);
                    $('.modal-invate-text').val('');
                    $('.feedback').style.color = 'green';
                    alert(data.message);
                }
            },
            error: function(data) {
                console.log(data);
            }
        })

        // cái này để animation khi nhập sai
        $('.feedback').toggleClass('feedback-wrong');
    });


</script>
