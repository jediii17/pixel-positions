<x-layout>
    <section class="max-w-2xl mx-auto  bg-white/10 p-6 rounded-xl shadow">

        <h1 class="text-bold text-2xl">Profile Information</h1>

        <x-forms.success>
            {{ session('success') }}
        </x-forms.success>

        <x-forms.error>
            {{ session('error') }}
        </x-forms.error>

        <x-forms.form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')
            <x-forms.input label="Name" name="name" value="{{ old('name', $user->name) }}" required/>
            <x-forms.input label="email" name="email" type="email" value="{{ old('email', $user->email) }}" required />

            <x-forms.button type="submit">Save Changes</x-forms.button>
        </x-forms.form>
    </section>

    <section class="max-w-2xl mx-auto  bg-white/10 p-6 rounded-xl shadow mt-5">

        <h1 class="text-bold text-2xl">Change Password</h1>

        <x-forms.success>
            {{ session('success') }}
        </x-forms.success>

        <x-forms.error>
            {{ session('error') }}
        </x-forms.error>

        <x-forms.form action="{{ route('profile.updatePassword') }}" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')
            <x-forms.input type="password" label="Current Password" name="current_password" required/>
            <x-forms.input type="password" label="New Password" name="password" required />
            <x-forms.input type="password" label="Confirm Password" name="password_confirmation" required />

            <x-forms.button type="submit">Change Password</x-forms.button>
        </x-forms.form>
    </section>
</x-layout>
