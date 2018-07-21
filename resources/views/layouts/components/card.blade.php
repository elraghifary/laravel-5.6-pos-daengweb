<div class="card">
    <div class="card-header with-border">
        <h3 class="card-title">{{ $card_title }}</h3>
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
    {{ $card_footer }}
</div>