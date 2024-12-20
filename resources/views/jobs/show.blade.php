<x-layout>
    <x-page-heading>List of Jobs</x-page-heading>

    <div class="mb-6">
        <x-forms.success>
            {{ session('success') }}
        </x-forms.success>

        <x-forms.error>
            {{ session('error') }}
        </x-forms.error>
    </div>
    
    <div class="grid lg:grid-cols-3 gap-8 mt-6">
        @if($jobs->isEmpty())
            <div class="text-center text-gray-500">
                <p class="text-lg font-semibold">You haven't posted any jobs yet.</p>
            </div>
        @else
            @foreach($jobs as $job)
                <x-job-card-list :$job />
            @endforeach
        @endif
    </div>
</x-layout>
