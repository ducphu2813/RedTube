<link rel="stylesheet" href="{{ asset('css/studio/studioContents.css') }}">

<div class="content__title">Channel content</div>

<ul class="content__option">
    <li class="content__option--item selected" data-url="{{ route('studio.contents.videos') }}">Videos</li>
    <li class="content__option--item" data-url="{{ route('studio.contents.playlists') }}">Playlists</li>
</ul>

<!-- body -->
<div class="content__body" id="body">

</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ route('studio.contents.videos') }}',
            type: 'GET',
            data: {
                currentPage: 1,
                itemPerPage: 1
            },
            dataType: 'html',
            success: function(data) {
                $('#body').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching content:', error);
            }
        });

        $('.content__option--item').on('click', function(event) {
            $('.content__option--item').removeClass('selected');
            $(this).addClass('selected');
            var url = $(this).data('url');
            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    $('#body').html(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching content:', error);
                }
            });

            event.preventDefault();
        });
    });

    function loadPage(page) {
        $.ajax({
            url: '{{ route('studio.contents.videos') }}',
            type: 'GET',
            data: {
                currentPage: page
            },
            dataType: 'html',
            success: function(data) {
                $('#body').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching content:', error);
            }
        });
    }
</script>




