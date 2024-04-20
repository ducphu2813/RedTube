<div>
    @foreach($comments as $cmt)
        <div>
            <p>{{ $cmt->user->user_name }} - {{ $cmt->created_date }}</p>
            <p>{{ $cmt->content }}</p><br>
        </div>

    @endforeach
</div>
