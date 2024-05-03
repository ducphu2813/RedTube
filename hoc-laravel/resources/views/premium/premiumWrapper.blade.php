<link rel="stylesheet" href="{{ asset('/css/premium.css') }}">
<div class="content__title">Premium</div>
<button class="add-share-pre">+</button>

<ul class="content__option">
    <li class="content__option--item selected">Premium</li>
    <li class="content__option--item">Premium Gia Đình</li>
</ul>



<div class="content__body">
    @component('premium.premiumHistoryWrapper')
    @endcomponent
</div>
</div>

<script>
    $(document).ready(function() {
        $('.content__option--item').click(function() {
            $('.content__option--item').removeClass('selected');
            $(this).addClass('selected');
            $('.content__body').empty();
            if ($(this).text() === 'Premium') {
                $('.content__body').append(`
                    @component('premium.premiumHistoryWrapper')
                    @endcomponent
                `);
            } else {
                $('.content__body').append(`
                    @component('premium.premiumShareWrapper')
                    @endcomponent
                `);
            }
        });
    });
</script>