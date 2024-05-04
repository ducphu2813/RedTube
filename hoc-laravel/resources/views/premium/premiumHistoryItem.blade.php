<a class="my-premium-info" href="">
    <div class="my-premium-name">
        {{ $registration->package->name}}
    </div>

    <div class="my-premium-start">
        {{ $registration->start_date->format('d/m/Y') }}
    </div>

    <div class="my-premium-end">
        {{ $registration->end_date->format('d/m/Y') }}
    </div>
</a>
