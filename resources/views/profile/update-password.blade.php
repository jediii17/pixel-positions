<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<section class="max-w-2xl mx-auto bg-white/10 p-6 rounded-xl shadow mt-5 px-5 py-5">
    <h1 class="text-bold text-4xl">Change Password</h1>

    <x-forms.success class="mt-5" key="password_success" />
    <x-forms.error key="password_error" />

    <x-forms.form action="{{ route('profile.updatePassword') }}" method="POST" class="space-y-4">
        @csrf
        @method('PATCH')

        <x-forms.input type="password" label="Current Password" name="current_password" required />

        <div class="relative">
            <x-forms.input type="password" label="New Password" name="password" id="new-password" required class="pr-10" />
            <button type="button" id="toggle-new-password" class="absolute right-4 top-14 transform -translate-y-1/2 text-gray-500">
                <i class="fas fa-eye"></i>
            </button>
        </div>

        <div class="relative">
            <x-forms.input type="password" label="Confirm Password" name="password_confirmation" id="confirm-password" required class="pr-10" />
            <button type="button" id="toggle-confirm-password" class="absolute right-4 top-14 transform -translate-y-1/2 text-gray-500">
                <i class="fas fa-eye"></i>
            </button>
        </div>
        
        

        <div id="password-error" class="text-sm text-red-600 mt-2 hidden">Passwords do not match.</div>
        <div id="password-success" class="text-sm text-green-600 mt-2 hidden">Passwords match.</div>

        <div id="password-validation-errors" class="text-sm text-red-600 mt-2 hidden">
            <ul>
                <li id="length-error" class="hidden">Password must be at least 8 characters.</li>
                <li id="uppercase-error" class="hidden">Password must contain at least one uppercase letter.</li>
                <li id="lowercase-error" class="hidden">Password must contain at least one lowercase letter.</li>
                <li id="number-error" class="hidden">Password must contain at least one number.</li>
                <li id="special-char-error" class="hidden">Password must contain at least one special character (!, ., -, @, #).</li>
            </ul>
        </div>

        <x-forms.button type="submit">Change Password</x-forms.button>
    </x-forms.form>
</section>

<script>
    const newPassword = document.getElementById('new-password');
    const confirmPassword = document.getElementById('confirm-password');
    const toggleNewPassword = document.getElementById('toggle-new-password');
    const toggleConfirmPassword = document.getElementById('toggle-confirm-password');
    
    const errorDiv = document.getElementById('password-error');
    const successDiv = document.getElementById('password-success');
    const validationErrorsDiv = document.getElementById('password-validation-errors');
    
    const lengthError = document.getElementById('length-error');
    const uppercaseError = document.getElementById('uppercase-error');
    const lowercaseError = document.getElementById('lowercase-error');
    const numberError = document.getElementById('number-error');
    const specialCharError = document.getElementById('special-char-error');

    function checkPasswordMatch() {
        if (confirmPassword.value !== newPassword.value || confirmPassword.value === '') {
            successDiv.classList.add('hidden');
            errorDiv.classList.remove('hidden');
        } else {
            errorDiv.classList.add('hidden');
            successDiv.classList.remove('hidden');
        }
    }

    function checkPasswordValidation() {
        const validations = [
            { regex: /.{8,}/, errorElement: lengthError },
            { regex: /[A-Z]/, errorElement: uppercaseError },
            { regex: /[a-z]/, errorElement: lowercaseError },
            { regex: /[0-9]/, errorElement: numberError },
            { regex: /[!.\-@#]/, errorElement: specialCharError }
        ];

        let isValid = true;

        validations.forEach(validation => {
            if (!validation.regex.test(newPassword.value)) {
                validation.errorElement.classList.remove('hidden');
                isValid = false;
            } else {
                validation.errorElement.classList.add('hidden');
            }
        });

        validationErrorsDiv.classList.toggle('hidden', isValid);
    }

    toggleNewPassword.addEventListener('click', () => {
        const type = newPassword.type === 'password' ? 'text' : 'password';
        newPassword.type = type;
        toggleNewPassword.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });

    toggleConfirmPassword.addEventListener('click', () => {
        const type = confirmPassword.type === 'password' ? 'text' : 'password';
        confirmPassword.type = type;
        toggleConfirmPassword.innerHTML = type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>';
    });

    confirmPassword.addEventListener('input', checkPasswordMatch);
    newPassword.addEventListener('input', checkPasswordValidation);
</script>
