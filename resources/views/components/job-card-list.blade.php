@props(['job'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm">{{ $job->employer->name }}</div>

    <div class="py-8">
        <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
            {{ $job->title }}
        </h3>
        <p class="text-sm mt-4">{{ $job->salary }}</p>

        <p class="text-sm text-gray-500 mt-2">
            Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
        </p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div class="flex items-center space-x-2">
            @foreach($job->tags->take(3) as $tag)
                <x-tag :tag="$tag" size="small" />
            @endforeach
    
            @if($job->tags->count() > 3)
                <span class="bg-white/10 hover:bg-white/25 rounded-xl font-bold transition-colors duration-300 text-2xs px-3 py-1">...</span>
            @endif
        </div>

        <x-employer-logo :employer="$job->employer" :width="42" />
    </div>

    @can('apply', $job)
        <x-forms.button2 href="/apply/{{ $job->id }}" class="self-start mt-6 text-sm font-bold hover:text-gray-800 bg-blue-600 hover:bg-blue-800 transition-colors duration-300">
            Apply Now
        </x-forms.button2>
    @endcan

    <div class="flex justify-between items-center mt-6">
        <button 
            onclick="openDeleteModal({{ $job->id }}, '{{ $job->title }}')" 
            class="px-4 py-2 bg-red-500 text-white/80 text-sm font-semibold rounded-lg shadow hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300 transition duration-150"
        >
            Delete
        </button>

        <a 
            href="{{ route('jobs.applicants', $job->id) }}" 
            class="px-4 py-2 bg-blue-500 text-white/80 text-sm font-semibold rounded-lg shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-300 transition duration-150"
        >
            View Applicant
        </a>
    </div>
    
    <x-delete-modal :title="'Delete job: ' . $job->title" />
</x-panel>
