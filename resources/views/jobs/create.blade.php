<x-layout>
    <x-page-heading>New Job</x-page-heading>

    <x-forms.form method="POST" action="/jobs">
        <x-forms.input label="Title" name="title" placeholder="CEO" />
        <x-forms.input label="Salary" name="salary" placeholder="$90,000 USD" />
        <x-forms.input label="Location" name="location" placeholder="Winter Park, Florida" />

        <x-forms.select label="Schedule" name="schedule">
            <option>Part Time</option>
            <option>Full Time</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="https://acme.com/jobs/ceo-wanted" />
        <x-forms.checkbox label="Feature (Costs Extra)" name="featured" />

        <x-forms.divider />

        <x-forms.input id="tags-input" label="Tags (comma separated)" name="tags" placeholder="Software, Developer, Associate"  />

        <x-forms.button>Publish</x-forms.button>
    </x-forms.form>

    <script>
        const tagsInput = document.getElementById('tags-input');
        const errorContainer = document.createElement('div');
        tagsInput.parentNode.appendChild(errorContainer);

        tagsInput.addEventListener('input', function () {
            errorContainer.textContent = ''; 

            const tags = tagsInput.value.split(',').map(tag => tag.trim());

            if (tags.length > 3) {
                errorContainer.textContent = 'You can only add a maximum of 3 tags.';
                errorContainer.classList.add('text-red-700', 'mt-2');
                return;
            }

            const invalidTags = tags.filter(tag => tag.includes(' '));
            if (invalidTags.length > 0) {
                errorContainer.textContent = 'Tags must be a single word without spaces.';
                errorContainer.classList.add('text-red-700', 'mt-2');
            }
        });
    </script>
</x-layout>
