<div class="modal-share-premium">
    <div class="modal-share-content">
        <div class="modal-share-header">
            <div class="modal-share-title">
                Danh sách chia sẻ Premium
            </div>
            <button class="close-modal">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div class="modal-share-body">

            <div class="modal-share-body--item">
                <div class="modal-share-body--item--name" style="font-weight: 600; font-size: 16px">
                    Tên người nhận
                </div>
                <div class="modal-share-body--item--name" style="font-weight: 600; font-size: 16px">
                    Tình trạng
                </div>
                <div class="modal-share-body--item--name" style="font-weight: 600; font-size: 16px">
                    Hủy
                </div>
            </div>
            {{-- Danh sách người nhận ở đây --}}
            {{-- Người nào nhận rồi thì thêm class invated (color: green) --}}
            @foreach($premiumRegistration->sharedUsers as $shared_premium)
                @if($shared_premium->expiry_date > date('Y-m-d H:i:s'))
                    <div class="modal-share-body--item">
                        <div class="modal-share-body--item--name">
                            {{ $shared_premium->user->user_name }}
                        </div>
                        <div class="noti-invate invated">
                            Đã chấp nhận
                        </div>
                        <div>
                            <button class="del-share" obj_id="{{ $shared_premium->share_id }}" receiver_id="{{ $shared_premium->user_id }}" obj="using_share">
                                <i class="fa-solid fa-xmark"></i>
                            </button>
                        </div>
                    </div>

                @else
                    {{-- danh sách người đã nhận rồi hủy ngang--}}
                    <div class="modal-share-body--item">
                        <div class="modal-share-body--item--name">
                            {{ $shared_premium->user->user_name }}
                        </div>
                        <div class="noti-invate" style="color:red;">
                            Đã hủy
                        </div>
                        <div>

                        </div>
                    </div>
                @endif
            @endforeach

            {{-- danh sách đang gửi nhưng chưa nhận được phản hồi--}}
            @foreach($shareNoti as $noti)
                <div class="modal-share-body--item">
                    <div class="modal-share-body--item--name">
                        {{ $noti->receiver->user_name }}
                    </div>
                    @if($noti->expiry_date < date('Y-m-d H:i:s'))
                        <div class="noti-invate" style="color:red;">
                            Hết hiệu lực
                        </div>
                    @else
                        <div class="noti-invate" style="color:#E8A207;">
                            Chưa chấp nhận
                        </div>
                    @endif
                    <div>
                        <button class="del-share" obj_id="{{ $noti->noti_id }}" receiver_id="{{ $noti->receiver->user_id }}" obj="share_noti">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

            @endforeach
        </div>
    </div>
</div>

{{-- Code xóa người dùng pre-share ở đây nè --}}
{{-- Khi nào người khác chấp nhận thì đổi nội dung thành đã chấp nhận và thêm class .invated (premium.css) --}}
<script>
    //event cho button
    $('.del-share').click(function() {

        $.ajax({
            url: '{{ route('clients.deleteSharePremium') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                obj_id: $(this).attr('obj_id'),
                receiver_id: $(this).attr('receiver_id'),
                obj: $(this).attr('obj')
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
            },
            error: function(data) {
                console.log(data);
            }
        });

        alert('Xóa thành công');
        //xóa 1 dòng của button đó
        // $(this).parent().parent().remove();
    });
</script>
