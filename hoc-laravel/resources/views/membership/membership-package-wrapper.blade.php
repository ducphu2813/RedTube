<div class="package-wrapper">
    @if($listMembership)
        @foreach ($listMembership as $ms)
            @component('membership.membershipItem', ['ms' => $ms])
            @endcomponent
        @endforeach
    @endif
</div>