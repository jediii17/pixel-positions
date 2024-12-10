<x-layout>
    <x-page-heading>Register</x-page-heading>

    <x-forms.form method="POST" action="/register" enctype="multipart/form-data">
        @csrf

        <x-forms.input label="Name" name="name" />
        <x-forms.input label="Email" name="email" type="email" />
        <x-forms.input label="Password" name="password" type="password" />
        <x-forms.input label="Confirm Password" name="password_confirmation" type="password" />

        <x-forms.divider />

        <!-- Role selection -->
        <div class="mb-4">
            <label class="block font-medium text-xl text-white">Register as:</label>
            <div class="flex items-center space-x-4 mt-2">
                <label>
                    <input type="radio" name="role" value="employer" class="mr-2" required>
                    Employer
                </label>
                <label>
                    <input type="radio" name="role" value="member" class="mr-2" required>
                    Member
                </label>
            </div>
            @error('role')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div id="employer-fields" class="hidden">
            <x-forms.input label="Company Name" name="employer" />
            <x-forms.input label="Company Logo" name="logo" type="file" />
        </div>

        <x-forms.button>Create Account</x-forms.button>
    </x-forms.form>

    <script>
        const roleInputs = document.querySelectorAll('input[name="role"]');
        const employerFields = document.getElementById('employer-fields');

        roleInputs.forEach(input => {
            input.addEventListener('change', () => {
                if (input.value === 'employer') {
                    employerFields.classList.remove('hidden');
                } else {
                    employerFields.classList.add('hidden');
                }
            });
        });
    </script>
</x-layout>
