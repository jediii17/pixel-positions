@props(['key' => 'error'])

@if (session($key))
    <div {{ $attributes(['class' => 'mt-1']) }}>
        {{ session($key) }}
    </div>
@endif
