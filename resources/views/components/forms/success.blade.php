@if (session('success'))
    <div class="rounded-lg bg-green-100 p-4 mt-3 text-green-700">
        {{ $slot }}
    </div>
@endif
