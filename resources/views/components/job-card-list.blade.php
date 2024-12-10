@props(['job'])

<x-panel class="flex gap-x-6 relative">

    <div>
        <x-employer-logo :employer="$job->employer" />
    </div>

    <div class="flex-1 flex flex-col">
        <span class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $job->employer->name }}</span>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            {{ $job->title }}
        </h3>

        <p class="text-sm text-gray-400 mt-auto">{{ $job->salary }}</p>
    </div>

    <div class="absolute top-2 right-2">
        @foreach($job->tags as $tag)
            <x-tag :$tag />
        @endforeach
    </div>

    <div class="absolute bottom-4 right-4 space-x-2">
        <button onclick="openDeleteModal({{ $job->id }}, '{{ $job->title }}')" class="text-red-500 hover:text-red-700 text-sm">
            Delete Job
        </button>
        <a href="{{ route('jobs.applicants', $job->id) }}" class="text-blue-500 hover:text-blue-700 text-sm">
            View Applicants
        </a>
    </div>

    <x-delete-modal :title="'Delete job: ' . $job->title" />

</x-panel>
