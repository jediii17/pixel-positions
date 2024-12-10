@if (session('success'))
    <div {{ $attributes(['class' => 'rounded-lg bg-green-100 p-4 text-green-700']) }}>
        {{ $slot }}
    </div>
@endif
