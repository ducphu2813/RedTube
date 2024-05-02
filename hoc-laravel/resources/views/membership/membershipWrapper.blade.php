<link rel="stylesheet" href="{{ asset('css/membership.css') }}">
<div class="package-wrapper">
    @foreach ($listMembership as $ms)
        @component('membership.membershipItem', ['ms' => $ms])
        @endcomponent
    @endforeach
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
    });
</script>
