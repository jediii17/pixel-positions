@props(['job'])

<x-panel class="flex flex-col text-center">
    <div class="self-start text-sm">{{ $job->employer->name }}</div>

    <div class="py-8">
        <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
            <a href="{{ $job->url }}" target="_blank">
                {{ $job->title }}
            </a>
        </h3>
        <p class="text-sm mt-4">{{ $job->salary }}</p>

        <p class="text-sm text-gray-500 mt-2">
            Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
        </p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div>
            @foreach($job->tags as $tag)
                <x-tag :$tag size="small" />
            @endforeach
        </div>

        <x-employer-logo :employer="$job->employer" :width="42" />
    </div>

    @can('apply', $job)
        <x-forms.button2 href="/apply/{{ $job->id }}" class="self-start mt-6 text-sm font-bold hover:text-gray-800 bg-blue-600 hover:bg-blue-800 transition-colors duration-300">
            Apply Now
        </x-forms.button2>
    @endcan
</x-panel>
