<div>
    <h1>Tìm thấy {{ count($listUser) }} người dùng</h1>
    @foreach($listUser as $user)
        @if($user)
            <div>
                <p>{{ $user->user_id }}</p>
                <p>{{ $user->user_name }}</p>
                <p>{{ $user->email }}</p>
                <a href="{{ route('users.user-detail', $user->user_id) }}">Xem chi tiết</a>
                <hr>
            </div>
        @else
            @component('users.user-notfound')
            @endcomponent
        @endif
    @endforeach
</div>
