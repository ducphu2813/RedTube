<ul class="list-container">
    <div class="list-title">Kênh đăng ký</div>
    @foreach ($channels as $channel)
        <li class="list-item user-item" user_id='{{ $channel->user_id }}'>
            <a href="">
                <span class="list-icon">
                    <img src="{{ $channel->picture_url }}" alt="">
                </span>
                
                {{ $channel->channel_name }}
            </a>
        </li>
    @endforeach
</ul>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

<script>
    $(".list-container").ready(function() {
        $(".user-item").on('click', function(event) {
            var user_id = $(this).attr('user_id');

            $.ajax({
                url: '{{ route('clients.userChannel') }}',
                type: 'GET',
                data: {
                    user_id: user_id
                },
                dataType: 'html',
                success: function(data) {
                    $('#content').html(data);
                },
                error: function(jqXHR, textStatus, errorThrown, data) {
                    console.log('AJAX error:', textStatus, errorThrown);
                }
            });
            event.preventDefault();
        });
    });
</script>
