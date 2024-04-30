<div id="userWrapper">
    @foreach ($listUser as $user)
        @component('admin.userItem', ['user' => $user])
        @endcomponent
    @endforeach
</div>
