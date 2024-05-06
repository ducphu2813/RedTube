<div id="commentWrapper">
    @for ($i = 0; $i < 5; $i++)
        @component('admin.commentItem');
        @endcomponent
    @endfor
</div>
