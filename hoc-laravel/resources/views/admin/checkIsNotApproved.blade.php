<link rel="stylesheet" href="{{ asset('css/checkModal.css') }}">
<div class="review-modal-container-ignore" id="{{ $video->video_id }}">
    <div class="review-modal-ignore">
        <div class="review-modal-ignore-info">
            <h2 class="">Từ chối video</h2>
            <div class="group-info">
                <h5>Lý do</h5>
                <select name="" id="" class="message-group">
                    <option value="" class="message-item">Nội dung bạo lực hoặc nguy hiểm</option>
                    <option value="" class="message-item">Nội dung kích động thù địch</option>
                    <option value="" class="message-item">Nội dung lạm dụng tình dục trẻ em</option>
                    <option value="" class="message-item">Nội dung liên quan đến trẻ em</option>
                    <option value="" class="message-item">Spam và hành vi lừa đảo</option>
                    <option value="" class="message-item">Nội dung có hại hoặc nguy hiểm</option>
                    <option value="" class="message-item">Thông tin sai lệch</option>
                </select>
            </div>

        </div>
        <div class="review-modal-btn">
            <div class="review-modal-btn-item" id="review-modal-btn-cancel">Hủy</div>
            <div class="review-modal-btn-item" id="review-modal-btn-acp">Từ chối</div>
        </div>
    </div>
</div>

<script>
    $('#review-modal-btn-acp').on('click', function() {
        var message = $('.message-group').find('option:selected').text();
        console.log(message);
            $.ajax({
                url: "{{ route('admin.ignoreVideo') }}",
                type: 'POST',
                data: {
                    video_id: {{ $video->video_id }},
                    note: message,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    console.log(response);
                    if(response.status === 'ignore'){
                        alert('Từ chối video thành công');
                        $('#review-modal-btn-cancel').trigger('click');
                        // Xóa phần tử khỏi DOM
                        $('#'+{{ $video->video_id }}).remove();
                    }
                }
            })

            // console.log(data);
        });
</script>