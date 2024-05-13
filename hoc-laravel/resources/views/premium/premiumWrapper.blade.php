<link rel="stylesheet" href="{{ asset('/css/premium.css') }}">
<div class="content__title">Premium</div>

<button class="modal-share-btn--item">
    <span class="span"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 23 21" height="21"
            width="23" class="svg-icon">
            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="2" stroke="black"
                d="M1.97742 19.7776C4.45061 17.1544 7.80838 15.5423 11.5068 15.5423C15.2053 15.5423 18.5631 17.1544 21.0362 19.7776M16.2715 6.54229C16.2715 9.17377 14.1383 11.307 11.5068 11.307C8.87535 11.307 6.74212 9.17377 6.74212 6.54229C6.74212 3.91082 8.87535 1.77759 11.5068 1.77759C14.1383 1.77759 16.2715 3.91082 16.2715 6.54229Z">
            </path>
        </svg></span>
    <span class="lable">Invite</span>
</button>

<ul class="content__option">
    <li class="content__option--item selected" id="myPre">Premium Của Tôi</li>
    <li class="content__option--item" id="sharedPre">Premium Được Chia Sẻ</li>
</ul>

<div class="content__body">
    @component('premium.premiumShareWrapper')
    @endcomponent
</div>

<script>
    $(document).ready(function() {
        // Chuyển tab
        $('.content__option--item').click(function() {
            $('.content__option--item').removeClass('selected');
            $(this).addClass('selected');
            if ($(this).attr('id') == 'myPre') {
                $.ajax({
                    url: '{{ route('clients.mySharePremium') }}',
                    type: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        $('.content__body').html(data);
                    }
                })
            } else {
                $.ajax({
                    url: '{{ route('clients.receiveShare') }}',
                    type: 'GET',
                    dataType: 'html',
                    success: function(data) {
                        $('.content__body').html(data);
                    }
                })
            }
        });

        // Xử lý khi click vào nút invite
        $('.modal-share-btn--item').click(function() {
            $.ajax({
                url: '{{ route('clients.invitePremium') }}',
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    $('#modal').html(data);


                }
            })
        });

        // Xử lý disable nếu không có premium
        // Disable nút invite
        // $('.modal-share-btn--item').prop('disabled', true);
        // Enable nút invite
        // $('.modal-share-btn--item').prop('disabled', false);
    });
</script>
