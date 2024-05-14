<div id="userWrapper">
    @foreach ($listUser as $user)
        @component('admin.userItem', ['user' => $user])
        @endcomponent
    @endforeach
</div>

<script>
    $(document).ready(function() {
        $('.item-container').on('change', '#user-role', function() {
            var role = $(this).val();
            var id = $(this).parent().parent().attr('id');
            console.log(role);
            console.log(id);
            $.ajax({
                url: "{{ route('admin.changeRoleUser') }}",
                type: 'POST',
                data: {
                    user_id: id,
                    role: role,
                    _token: "{{ csrf_token() }}"
                },
                cache: false,
                success: function(response) {
                    console.log("Thành công");
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        });

        $('.item-container').on('change', '.item-btn', function() {
            var status;
            var id = $(this).parent().attr('id');
            if ($(this).find('input').is(":checked")) {
                if (confirm("Bạn có muốn khóa tài khoản?")) {
                    status = 0;
                } else {
                    $(this).find('input').prop('checked', false);
                }
            } else {
                if (confirm("Bạn có muốn mở khóa tài khoản?")) {
                    status = 1;
                } else {
                    $(this).find('input').prop('checked', true);
                }
            }
            console.log(status);
            console.log(id);
            $.ajax({
                url: "{{ route('admin.changeStatusUser') }}",
                type: 'POST',
                data: {
                    user_id: id,
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
