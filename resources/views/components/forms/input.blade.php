@props(['label', 'name'])

@php
    $defaults = [
        'type' => 'text',
        'id' => $name,
        'name' => $name,
        'class' => 'rounded-lg bg-white/10 border px-5 py-4 w-full ' . 
                  ($errors->has($name) ? 'border-red-500' : 'border-white/10') .
                  (!in_array($name, ['email', 'password', 'current_password', 'password_confirmation', 'resume', 'tags', 'url']) ? ' capitalize-input' : ''),
        'value' => old($name),
    ];
@endphp

<x-forms.field :$label :$name>
    <input {{ $attributes($defaults) }}>
    
    @error($name)
        <div class="mt-2 text-sm text-red-600">
            {{ $message }}
        </div>
    @enderror
</x-forms.field>

<script>
    document.querySelectorAll('.capitalize-input').forEach(inputField => {
        inputField.addEventListener('input', function () {
            const words = inputField.value.split(' ');
            const capitalizedWords = words.map(word => word.charAt(0).toUpperCase() + word.slice(1));
            inputField.value = capitalizedWords.join(' ');
        });
    });
</script>
