@if (session('error'))
    <div class="mb-4 rounded-lg bg-red-100 p-4 text-red-700">
        {{ $slot }}
    </div>
@endif
