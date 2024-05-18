{{-- Dùng user của admin --}}
<div class="item-container" id="{{ $user->user_id }}">
    <div class="item-account">
        <a href="">

            @if ($user->picture_url)
                <img src="{{ asset('storage/img/' . $user->picture_url) }}" alt="" class="logo">
            @else
                <img src="{{ asset('resources/img/defaulftPFP.jpg') }}" alt="" class="logo">
            @endif

        </a>
    </div>
    <div class="item-name">
        <p>{{ $user->user_name }}</p>
    </div>
    <div class="item-role">

        <select name="" id="user-role">
            <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Người dùng</option>
            <option value="2" {{ $user->role == 2 ? 'selected' : '' }}>Người kiểm duyệt</option>
            <option value="3" {{ $user->role == 3 ? 'selected' : '' }}>Người quản trị</option>
        </select>
    </div>
    <div class="item-btn">
        <label class="container">
            <input {{ $user->active == 1 ? '' : 'checked'}} type="checkbox">
            <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="lock-open">
                <path d="M352 144c0-44.2 35.8-80 80-80s80 35.8 80 80v48c0 17.7 14.3 32 32 32s32-14.3 32-32V144C576 64.5 511.5 0 432 0S288 64.5 288 144v48H64c-35.3 0-64 28.7-64 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V256c0-35.3-28.7-64-64-64H352V144z"></path>
            </svg>
            <svg viewBox="0 0 448 512" height="1em" xmlns="http://www.w3.org/2000/svg" class="lock">
                <path d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"></path>
            </svg>
        </label>
    </div>

</div>
