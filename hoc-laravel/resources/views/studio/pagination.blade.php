<link rel="stylesheet" href="{{ asset('css/studio/pagination.css') }}">

<!-- footer -->
<div class="content__footer">

    <!-- pagination -->
    <div class="pagination">

        <button class="pagi--btn" id="arrow--left">
            <i class="fa-solid fa-angles-left"></i>
        </button>

        <button class="pagi--btn" id="chevron--left">
            <i class="fa-solid fa-chevron-left"></i>
        </button>

        <button class="pagi--btn page">
            1
        </button>

        <button class="pagi--btn page">
            2
        </button>

        <button class="pagi--btn unselectable">
            ...
        </button>

        <button class="pagi--btn page">
            5
        </button>

        <button class="pagi--btn page">
            6
        </button>

        <button class="pagi--btn" id="chevron--right">
            <i class="fa-solid fa-chevron-right"></i>
        </button>

        <button class="pagi--btn" id="arrow--right">
            <i class="fa-solid fa-angles-right"></i>
        </button>
    </div>

    {{-- <div class="pagination">
        <!-- Render pagination buttons based on total pages -->
        @for ($i = 1; $i <= $totalPages; $i++)
            <button class="page-link" onclick="selectPage({{ $i }})" @if($i == $currentPage) disabled @endif>{{ $i }}</button>
        @endfor
    </div>
    
    <script>
        function selectPage(pageNumber) {
            $.ajax({
                url: '',
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    $('#right').html(data);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching content:', error);
                }
            });
        }
    </script> --}}
</div>
