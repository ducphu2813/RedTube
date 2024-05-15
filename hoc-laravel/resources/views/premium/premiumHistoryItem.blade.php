<a class="my-premium-info" href="">
    <div class="my-premium-user-name">
        {{ $shared_premium->premiumRegistration->user->user_name }}
    </div>

    <div class="my-premium-name">
        {{ $shared_premium->premiumRegistration->package->name }}
    </div>

    <div class="my-premium-start">
        {{ $shared_premium->created_date }}
    </div>

    <div class="my-premium-end">
        {{  $shared_premium->expiry_date  }}
    </div>

    @if($shared_premium->expiry_date > date('Y-m-d H:i:s'))
        <div class="pre-share-quantity">
            <i class="fa fa-xmark btn-detail-share" style="line-height: 31px"></i>
        </div>
    @else
        <div class="pre-share-quantity">
            Đã hết hạn
        </div>
    @endif

</a>
