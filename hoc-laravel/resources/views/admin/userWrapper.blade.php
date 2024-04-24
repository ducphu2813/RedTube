<div id="userWrapper">
    @for ($i = 0; $i < 5; $i++)
        @component('admin.userItem')
        @endcomponent
    @endfor
</div>