<section class="max-w-2xl mx-auto bg-white/10 p-6 rounded-xl shadow mt-5 px-5 py-5">
    <h1 class="text-bold text-4xl">Change Password</h1>

    <x-forms.success class="mt-5" key="password_success" />
    <x-forms.error key="password_error" />

    <x-forms.form action="{{ route('profile.updatePassword') }}" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')

        <x-forms.input type="password" label="Current Password" name="current_password" required />
        <x-forms.input type="password" label="New Password" name="password" id="new-password" required />
        <x-forms.input type="password" label="Confirm Password" name="password_confirmation" id="confirm-password" required />

        <div id="password-error" class="text-sm text-red-600 mt-2 hidden">Passwords do not match.</div>
        <div id="password-success" class="text-sm text-green-600 mt-2 hidden">Passwords match.</div>

        <x-forms.button type="submit">Change Password</x-forms.button>
    </x-forms.form>
</section>

<script>
    const newPassword = document.getElementById('new-password');
    const confirmPassword = document.getElementById('confirm-password');
    const errorDiv = document.getElementById('password-error');
    const successDiv = document.getElementById('password-success');

    function checkPasswordMatch() {
        
        if (newPassword.value !== confirmPassword.value || confirmPassword.value === '') {
           
            successDiv.classList.add('hidden');
            errorDiv.classList.remove('hidden');
        } else {
            
            errorDiv.classList.add('hidden');
            successDiv.classList.remove('hidden');
        }
    }
    confirmPassword.addEventListener('input', checkPasswordMatch);
</script>
