<div class="pre-share-info" href="">
    <div class="pre-share-name">
        {{ $premium->package->name }}
    </div>

    <div class="pre-share-start">
        {{ $premium->start_date }}
    </div>

    <div class="pre-share-end">
        {{ $premium->end_date }}
    </div>

    <div class="pre-share-quantity">
        <button class="btn-detail-share" pre-id="{{ $premium->registration_id }}">!</button>
    </div>
</div>
