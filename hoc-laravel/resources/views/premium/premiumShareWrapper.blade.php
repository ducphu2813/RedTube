<div class="pre-share-wrapper">
    <div class="pre-share-info">
        <div class="pre-share-name">
            <h5>Tên gói premium</h5>
        </div>

        <div class="pre-share-start">
            <h5>Ngày bắt đầu</h5>
        </div>

        <div class="pre-share-end">
            <h5>Ngày kết thúc</h5>
        </div>

        <div class="pre-share-quantity">
            <h5>Thông tin chi tiết</h5>
        </div>
    </div>

    {{-- Chổ này đổ data của gói premium --}}
    @if($all_premium->count() > 0)
        @foreach($all_premium as $premium)
            @component('premium.premiumShareItem', ['premium' => $premium])
            @endcomponent
        @endforeach
    @endif

{{--    @for ($i = 0; $i < 5; $i++)--}}
{{--        @component('premium.premiumShareItem')--}}
{{--        @endcomponent--}}
{{--    @endfor--}}
</div>

<script>

    // Hiển thị danh sách người được chia sẻ premium
    // Kèm theo nút đóng modal
    $(document).ready(function() {

        //nút coi chi tiết share
        $('.btn-detail-share').click(function() {

            let registration_id = $(this).attr('pre-id');
            // console.log('click')
            $.ajax({
                url: '{{ route('clients.modalPremium') }}',
                type: 'POST',
                data: {
                    registration_id: registration_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#modal').append(data);
                    $('.modal-share-premium').css('display', 'flex');
                    $('.close-modal').click(function() {
                        $('#modal').empty();
                    });
                },
                error: function(data) {
                    console.log(data);
                }
            })
        });

        // Cái này click bất kì ngoài modal thì ẩn modal đi
        $(document).click(function(event) {
            var target = $(event.target);
            if(!target.closest('.modal-share-content').length && $('.modal-share-premium').is(":visible")) {
                $('#modal').empty();
            }
        });

    });
</script>
