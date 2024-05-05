<div id="expanded-reply">
    <div>
        <button type="button" class="btn btn-outline-primary">Phản hồi</button>
    </div>

    {{-- Chổ này cho comment-reply-item --}}
    <div class="show-comment">
        @for ($i = 0; $i < 2; $i++)
            @component('comments.comment-reply-item')
            @endcomponent
        @endfor
    </div>

</div>

<script>
    // Xử lý nút phản hồi
</script>
