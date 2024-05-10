<a class="my-premium-info" href="">
    <div class="my-premium-name">
        {{ $listRegistration->package->name }}
    </div>

    <div class="my-premium-start">
        {{ $listRegistration->start_date->format('d/m/Y') }}
    </div>

    <div class="my-premium-end">
        {{ $listRegistration->end_date->format('d/m/Y') }}
    </div>
</a>
