<div id="videoWrapper">
    @foreach ($listVideo as $video)
        @component('admin.videoItem', ['video' => $video])
        @endcomponent
    @endforeach
</div>

<script>
    $(document).ready(function() {
        $('.item-container').on('change', '.item-btn', function() {
            var status;
            var id = $(this).parent().attr('id');
            if ($(this).find('input').is(":checked")) {
                if (confirm("Bạn có muốn khóa Video?")) {
                    status = 0;
                } else {
                    $(this).find('input').prop('checked', false);
                }
            } else {
                if (confirm("Bạn có muốn mở khóa Video?")) {
                    status = 1;
                } else {
                    $(this).find('input').prop('checked', true);
                }
            }
            console.log(status);
            console.log(id);
            $.ajax({
                url: "{{ route('admin.changeStatusVideo') }}",
                method: 'POST',
                data: {
                    video_id: id,
                    active: status,
                    _token: "{{ csrf_token() }}"
                },
                cache: false,
                success: function(response) {
                    alert("Thay đổi trạng thái");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

    });
</script>