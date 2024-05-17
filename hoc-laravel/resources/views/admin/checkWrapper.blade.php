<div class="review-all-header">Video chưa duyệt</div>
<div id="checkWrapper">

    @foreach ($listCheck as $check)
        @component('admin.checkItem', ['check' => $check])
        @endcomponent
    @endforeach
</div>

<script>
    $(document).ready(function() {
        $('.icon-btn-acp').on('click', function() {
            var id = $(this).closest('.item-container').attr('id');
            console.log(id);
            $.ajax({
                url: "{{ route('admin.showCheckModal') }}",
                type: 'POST',
                dataType: 'html',
                data: {
                    _token: '{{ csrf_token() }}',
                    video_id: id
                },
                success: function(data) {
                    $('#admin-modal').html(data);

                    $('#review-modal-btn-cancel').on('click', function() {
                        $('#admin-modal').empty();
                    });
                },
            });
        });

        $('.icon-btn-ign').on('click', function() {
            var id = $(this).closest('.item-container').attr('id');
            console.log(id);
            $.ajax({
                url: "{{ route('admin.showCheckModalIgnore') }}",
                type: 'POST',
                dataType: 'html',
                data: {
                    _token: '{{ csrf_token() }}',
                    video_id: id
                },
                success: function(data) {
                    $('#admin-modal').html(data);

                    $('#review-modal-btn-cancel').on('click', function() {
                        $('#admin-modal').empty();
                    });
                },
            });
        });
    })
</script>
