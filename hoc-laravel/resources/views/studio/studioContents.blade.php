<link rel="stylesheet" href="{{ asset('css/studio/studioContents.css') }}">

<div class="content__title">Channel content</div>

<ul class="content__option">
    <li class="content__option--item selected" data-url="{{ route('studio.contents.videos', ['pageNumber' => 1]) }}">Videos</li>
    <li class="content__option--item" data-url="{{ route('studio.contents.playlists', ['pageNumber' => 1]) }}">Playlists</li>
</ul>

<!-- body -->
<div class="content__body" id="body">

</div>

{{-- @include('studio.pagination', ['totalPages' => $totalPages, 'currentPage' => $currentPage]) --}}


<script>
    $(document).ready(function() {

        $.ajax({
            url: '/studioPage/contents/videos/1',
            type: 'GET',
            dataType: 'html',
            success: function(data) {
                $('#body').html(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching content:', error);
            }
        });

        $('.content__option--item').on('click', function(event) {
            event.preventDefault();
            $('.content__option--item').removeClass('selected');
            $(this).addClass('selected');
            var url = $(this).data('url');
            $.ajax({
                url: '{{ route('playlist.createPlaylist') }}',
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    $('#body').html(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching content:', error);
                }
            });
        });
    });
</script>




