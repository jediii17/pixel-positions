@props(['key' => 'error'])

@if (session($key))
    <div {{ $attributes(['class' => 'mb-4 rounded-lg bg-red-100 p-4 text-red-700']) }}>
        {{ session($key) }}
    </div>
@endif
