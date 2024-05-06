<div class="package-container" id="{{ $ms->membership_id }}">
    <div class="package-title">
        <h2>{{ $ms->name }}</h2>
    </div>

    <div class="package-price">
        <h3>Giá: {{ $ms->price }}</h3>
    </div>

    <div class="package-description">
        <p>{{ $ms->description }}</p>
    </div>

    <div class="package-btn">
        <button class="package-btn-item package-edit">
            <i class="fa-solid fa-pen-to-square"></i>
        </button>

        <button class="package-btn-item package-del">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
</div>
