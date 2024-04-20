<div>
    <h1>Danh sách người dùng</h1>
    @foreach($listUser as $user)
        <div>
            <p>{{ $user->id }}</p>
            <p>{{ $user->name }}</p>
            <p>{{ $user->email }}</p>
        </div>
    @endforeach
</div>
