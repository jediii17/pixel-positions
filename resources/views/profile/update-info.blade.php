<section class="max-w-2xl mx-auto  bg-white/10 p-6 rounded-xl shadow px-5 py-5">

    <h1 class="text-bold text-4xl">Profile Information</h1>

    <x-forms.success class="mt-5" key="update_success" />
    <x-forms.error key="update_error" />


    <x-forms.form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')
        <x-forms.input label="Name" name="name" value="{{ old('name', $user->name) }}" required/>
        <x-forms.input label="email" name="email" type="email" value="{{ old('email', $user->email) }}" required />

        <x-forms.button type="submit">Save Changes</x-forms.button>
    </x-forms.form>
</section>