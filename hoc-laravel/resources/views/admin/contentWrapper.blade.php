<div id="contentWrapper">
    @for ($i = 0; $i < 5; $i++)
        @component('admin.adminItem', ['flag' => $flag])
        @endcomponent
    @endfor

</div>
