<div id="expanded-reply">
    <div>
        <button type="button" class="btn btn-outline-primary">Phản hồi</button>
    </div>

    {{-- Chổ này cho comment-reply-item --}}
{{--    show tất cả reply của 1 comment--}}
    <div class="show-comment" id="reply-section-{{ $comment->comment_id }}">

        @foreach ($replies as $reply)
            @component('comments.comment-reply-item', ['reply' => $reply])
            @endcomponent
        @endforeach
    </div>

    <script>
        // Xử lý nút phản hồi
    </script>
</div>
