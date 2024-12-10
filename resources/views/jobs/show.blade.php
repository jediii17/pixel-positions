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
    
    <div class="space-y-6">
        @foreach($jobs as $job)
            <x-job-card-list :$job />
        
        @endforeach
        
    </div>
    

</x-layout>
