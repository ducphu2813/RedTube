<div class="header-notify-list">
    {{-- Từng item video  --}}
    @for ($i = 0; $i < 10; $i++)
        <div class="header-notify-item">
            <a href="">
                <img class="channel-avatar-notify"
                    src="https://yt3.ggpht.com/ytc/AIdro_kt-sUf4kFDrZ4iaFcyK4EHwVz-jlvQBwjZSA6hQ9ogPEg=s88-c-k-c0x00ffffff-no-rj"
                    alt="">
                <div class="header-notify-info">
                    <div class="wrapper-header-notify-name">
                        <span class="header-notify-name">SỐNG CÙNG 3 EM GÁI TRONG 1 NHÀ !!! Xinh vừa thôi,
                            ai chịu được - LOVE IS ALL AROUND: THE ROOM</span>
                    </div>
                    <div class="wrapper-header-notify-description">
                        <i class="fa-solid fa-circle" style="color: #000000;"></i>
                        <span class="header-notify-description">1 ngày trước</span>
                    </div>
                </div>
                <img class="thumbnail-notify" src="https://i.ytimg.com/vi/0FFxM8WqtWI/hqdefault.jpg" alt="">
            </a>
        </div>
    @endfor

</div>
