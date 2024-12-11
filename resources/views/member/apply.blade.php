<x-layout>
    <x-page-heading class="text-left">Job Application</x-page-heading>

    <x-forms.error class="mb-8">
        {{ session('error') }}
    </x-forms.error>

    <form method="POST" action="/apply/{{ $job->id }}/application" enctype="multipart/form-data" class="px-10">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <x-forms.input label="Resume" name="resume" type="file" />
        
        <div class="my-5 flex items-center ">
            <span class="text-xl font-bold">Work Experience</span>
            <hr class="flex-grow border-t-1 border-gray-400 ml-4">
        </div>

        <x-forms.input label="Job Title" name="title" placeholder="Web Developer" />
        <x-forms.input label="Company" name="company" placeholder="Banana Laundry Shop" />

        <x-forms.button class="mt-5">Submit your application</x-forms.button>
    </form>
</x-layout>
