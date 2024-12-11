<section class="max-w-2xl mx-auto  bg-white/10 p-6 rounded-xl shadow mt-5">

    <h1 class="text-bold text-2xl">Change Password</h1>

    <x-forms.success class="mt-5" key="password_success" />
    <x-forms.error key="password_error" />


    <x-forms.form action="{{ route('profile.updatePassword') }}" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')
        <x-forms.input type="password" label="Current Password" name="current_password" required/>
        <x-forms.input type="password" label="New Password" name="password" required />
        <x-forms.input type="password" label="Confirm Password" name="password_confirmation" required />
    
        <x-forms.button type="submit">Change Password</x-forms.button>
    </x-forms.form>
    
</section>