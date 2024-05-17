<link rel="stylesheet" href="{{ asset('css/membership.css') }}">
<div class="content__title">
    Membership
</div>

<ul class="content__option">
    <li class="content__option--item selected" id="myMem">Membership Của Tôi</li>
    <li class="content__option--item" id="reMem">Membership Đã Đăng Ký</li>
</ul>

<div class="content__body">
    @component('membership.membership-package-wrapper', ['listMembership' => $listMembership])
    @endcomponent
</div>


<script>
    $(document).ready(function() {
        $('.package-edit').click(function() {
            var id = $(this).parent().parent().attr('id');
            $.ajax({
                url: '{{ route('membership.createMemberPackage') }}/' + id,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    console.log(data);
                }
            })
        });

        // Chuyển tab
        $('.content__option--item').click(function() {
            $('.content__option--item').removeClass('selected');
            $(this).addClass('selected');
            if ($(this).attr('id') == 'myMem') {
                $.ajax({
                    url: '{{ route('studio.showAllMembership') }}',
                    type: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        $('.content__body').html(data);
                    }
                })
            } else {
                $.ajax({
                    url: '{{ route('studio.membershipRegistration') }}',
                    type: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        $('.content__body').html(data);
                    }
                })
            }
        });
    });
</script>
