<ul class="list-container">
    <div class="list-title">Kênh đăng ký</div>
    @for ($i = 0; $i < 6; $i++)
        <li class="list-item">
            <a href="">
                <span class="list-icon">
                    <img src="{{ asset('resources/img/ocean.jpg') }}" alt="">
                </span>
                Channel Name
            </a>
        </li>
    @endfor
</ul>
