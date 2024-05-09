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

    @for ($i = 0; $i < 5; $i++)
        @component('premium.premiumShareItem')
        @endcomponent
    @endfor

    {{-- @foreach ($listShares as $share)
        @component('premium.premiumShareItem', ['share' => $share])
        @endcomponent
    @endforeach --}}
</div>

<script>
    $(document).ready(function() {
        $('.btn-detail-share').click(function() {
            // console.log('click')
            $.ajax({
                url: '{{ route('clients.modalPremium') }}',
                type: 'GET',
                success: function(data) {
                    $('#modal').append(data);
                    $('.modal-share-premium').css('display', 'flex');
                    $('.close-modal').click(function() {
                        $('#modal').empty();
                    });
                }
            })
        });

        $(document).click(function(event) {
            var target = $(event.target);
            if(!target.closest('.modal-share-content').length && $('.modal-share-premium').is(":visible")) {
                $('#modal').empty();
            }        
        });

    });
</script>
