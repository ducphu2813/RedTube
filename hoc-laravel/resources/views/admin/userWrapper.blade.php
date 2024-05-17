<div class="review-all-header">Người dùng</div>
<div class="user-filter">
    <input type="radio" id="all" name="islock" value="1" checked>
    <label for="all">Tất cả</label><br>

    <input type="radio" id="accept" name="islock" value="2">
    <label for="accept">Không bị khóa</label><br>

    <input type="radio" id="reject" name="islock" value="3">
    <label for="reject">Bị khóa</label>
</div>

<div class="user-filter" style="margin-top: 15px;">
    <input type="radio" id="all" name="role" value="1" checked>
    <label for="all">Tất cả</label><br>

    <input type="radio" id="all" name="role" value="2">
    <label for="user">Người dùng</label><br>

    <input type="radio" id="accept" name="role" value="3">
    <label for="tester">Người kiểm duyệt</label><br>

    <input type="radio" id="reject" name="role" value="4">
    <label for="admin">Người quản trị</label>
</div>

<div id="userWrapper">
    @foreach ($listUser as $user)
        @component('admin.userItem', ['user' => $user])
        @endcomponent
    @endforeach
</div>

<script>
    $(document).ready(function() {
        // Gắn sự kiện cho các nút
        function bindItemBtnChange() {
            $('.item-container').on('change', '#user-role', function() {
                var role = $(this).val();
                var id = $(this).parent().parent().attr('id');
                // console.log(role);
                // console.log(id);
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
        }

        bindItemBtnChange();

        // Lọc ra những người bị khóa hoặc không bị khóa
        $(document).on('click', 'input[type=radio][name=islock]', function() {
            var lock = $('input[type=radio][name=islock]:checked').val();
            var role = $('input[type=radio][name=role]:checked').val();
            console.log(lock);
            console.log(role);
            $.ajax({
                url: "{{ route('admin.filterUser') }}",
                method: 'POST',
                data: {
                    is_active: lock,
                    role: role,
                    _token: "{{ csrf_token() }}"
                },
                cache: false,
                success: function(response) {
                    $('#userWrapper').html(response);
                    // console.log(response.videos);
                    // console.log(response);
                    if(response == "") {
                        $('#userWrapper').html("<h1 style='text-align: center;margin-top:100px;'>Không có dữ liệu</h1>");
                    }
                    bindItemBtnChange(); // Gán lại sự kiện sau khi cập nhật nội dung HTML
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });

        // Lọc ra vai trò của tài khoản
        $(document).on('click', 'input[type=radio][name=role]', function() {
            var lock = $('input[type=radio][name=islock]:checked').val();
            var role = $('input[type=radio][name=role]:checked').val();
            $.ajax({
                url: "{{ route('admin.filterUser') }}",
                method: 'POST',
                data: {
                    is_active: lock,
                    role: role,
                    _token: "{{ csrf_token() }}"
                },
                cache: false,
                success: function(response) {
                    $('#userWrapper').html(response);
                    if(response == "") {
                        $('#userWrapper').html("<h1 style='text-align: center; margin-top:100px;'>Không có dữ liệu</h1>");
                    }
                    // console.log(response.videos);
                    // console.log(response);
                    bindItemBtnChange(); // Gán lại sự kiện sau khi cập nhật nội dung HTML
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });


    });
</script>
