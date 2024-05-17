<div class="item">
    <a href="" class="small-thumnail"><img src="{{ asset('storage/thumbnail/' . $video->thumbnail_path) }}" alt="video"></a>
    <div class="infor-video">
        <a id="titlevideo" href="" style="font-family: Roboto, Arial, sans-serif">{{ $video->title }}</a>
        <p id="inforVideo">{{ $video->user->channel_name }}</p>
    </div>
</div>
