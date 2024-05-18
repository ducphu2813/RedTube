{{-- Sử dụng cho video/comment/check --}}
<div class="item-container" id="{{ $check->video_id }}" >
    <div class="item-account">
        <a href="">
{{--            <img src="{{ $check->user->picture_url }}" alt="" class="logo">--}}

            <img src="{{ asset('storage/thumbnail/' . $check->thumbnail_path) }}" alt="" class="logo">
        </a>
    </div>
    <div class="item-thumb">
        User: {{ $check->user->user_name }}
    </div>
    <div class="item-title">
        <p>{{ $check->title }}</p>
    </div>
    <div class="item-btn">
        <div class="icon-btn icon-btn-ign">
            <img src="{{ asset('resources/img/delete.svg') }}" alt="">
        </div>
        <div class="icon-btn icon-btn-acp">
            <img src="{{ asset('resources/img/check.svg') }}" alt="">
        </div>
    </div>
</div>
