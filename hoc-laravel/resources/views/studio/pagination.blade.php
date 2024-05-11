<link rel="stylesheet" href="{{ asset('css/studio/pagination.css') }}">

<!-- footer -->
<div class="content__footer">

    <!-- pagination -->
    <div class="pagination">

        <label for="itemPerPage">Hiển thị</label>
        <input type="text" id="itemPerPage" class="pagi">

        @if ($currentPage != 1)
            <button class="pagi--btn" id="chevron--left" page={{ $currentPage - 1 }}>
                <i class="fa-solid fa-chevron-left"></i>
            </button>
        @endif

        @if ($currentPage <= $pageDisplay)
            @for ($i = 1; $i <= $pageDisplay; $i++)
                @if ($i == $currentPage) 
                    <button class="pagi--btn page page--selected" page={{ $i }}>{{ $i }}</button>
                @else
                    <button class="pagi--btn page" page={{ $i }}>{{ $i }}</button>
                @endif
            @endfor

            <button class="pagi--btn unselectable" disabled>...</button>
            <button class="pagi--btn page" page={{ $totalPages }}>{{ $totalPages }}</button>

        @elseif ($currentPage > $pageDisplay && $currentPage < $totalPages - $pageDisplay + 1) 
            <button class="pagi--btn page" page={{ 1 }}>1</button>
            <button class="pagi--btn unselectable" disabled>...</button>
            
            @for ($i = $currentPage - floor($pageDisplay / 2); $i <= $currentPage + floor($pageDisplay / 2); $i++) 
                @if ($i == $currentPage)
                    <button class="pagi--btn page page--selected" page={{ $i }}>{{ $i }}</button>
                @else 
                    <button class="pagi--btn page" page={{ $i }}>{{ $i }}</button>
                @endif
            @endfor

            <button class="pagi--btn unselectable" disabled>...</button>
            <button class="pagi--btn page">{{$totalPages}}</button>

        @elseif ($currentPage >= $totalPages - $pageDisplay + 1) 
            <button class="pagi--btn page">1</button>
            <button class="pagi--btn unselectable" disabled>...</button>

            @for ($i = $totalPages - $pageDisplay + 1; $i <= $totalPages; $i++)
                @if ($i == $currentPage) 
                    <button class="pagi--btn page page--selected" page={{ $i }}>{{ $i }}</button>
                @else 
                    <button class="pagi--btn page" page={{ $i }}>{{ $i }}</button>
                @endif
            @endfor
        @endif

        @if ($currentPage != $totalPages)
            <button class="pagi--btn" id="chevron--right" page={{ $currentPage + 1 }}>
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        @endif
    </div>
</div>

<script>
    $('.content__footer').ready(function() {
        $('.pagi--btn').on('click', function(event) {
            var page = $(this).attr('page')
            loadPage(page)
        });
    });
</script>

