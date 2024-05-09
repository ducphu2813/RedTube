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
            {{-- Người nào nhận rồi thì thêm class invated --}}
            @for ($i = 0; $i < 6; $i++)
                {{-- Cái này là từng item --}}
                <div class="modal-share-body--item">
                    <div class="modal-share-body--item--name">
                        Nguyễn Văn A
                    </div>
                    <div class="noti-invate">
                        Chưa chấp nhận
                    </div>
                    <div>
                        <button class="del-share">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</div>

{{-- Code xóa người dùng pre-share ở đây nè --}}
{{-- Khi nào người khác chấp nhận thì đổi nội dung thành đã chấp nhận và thêm class .invated (premium.css) --}}
<script>

</script>