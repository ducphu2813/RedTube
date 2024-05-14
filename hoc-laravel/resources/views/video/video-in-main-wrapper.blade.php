<link rel="stylesheet" href="{{ asset('css/videoInMain.css') }}">
<div id="video-main-wrapper">
    @foreach($videos as $video)
        @component('video.video-in-main-item', ['video' => $video])
        @endcomponent
    @endforeach
</div>

{{-- Chổ này cho script control các video-item --}}
{{-- Hình như làm random video chổ này --}}
<script>
    $('.video-main-wrapper').ready(function() {
        $.ajax({
            url: '{{ route('studio.pagination') }}',
            type: 'GET',
            data: {
                url: '{{ $url }}',
                currentPage: {{ $currentPage }},
                itemPerPage: {{ $itemPerPage }},
                totalPages: {{ $totalPages }}, 
                pageDisplay: {{ $pageDisplay }}
            },
            dataType: 'html',
            success: function(data) {
                $('#content').append(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching content:', error);
                console.log({{ $currentPage }})
            }
        });
    });
</script>
