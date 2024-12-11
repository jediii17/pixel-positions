@props(['key' => 'success'])

@if (session($key))
    <div {{ $attributes(['class' => 'rounded-lg bg-green-100 p-4 text-green-700']) }}>
        {{ session($key) }}
    </div>
@endif
