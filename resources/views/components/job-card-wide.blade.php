@props(['job'])

<x-panel class="flex gap-x-6">

    <div>
        <x-employer-logo :employer="$job->employer" />
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $job->employer->name }}</a>

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            <a href="{{ $job->url }}" target="_blank">
                {{ $job->title }}
            </a>
        </h3>

        <p class="text-sm text-gray-400 mt-auto">{{ $job->salary }}</p>

        <p class="text-sm text-gray-500 mt-2">
            Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
        </p>
    </div>

    <div>
        @foreach($job->tags as $tag)
            <x-tag :$tag />
        @endforeach

        <div class="flex flex-col mt-5">
            @can('apply', $job)
                <x-forms.button2 href="/apply/{{ $job->id }}" class="self-end mt-6 text-sm font-bold bg-blue-600 hover:bg-blue-800 hover:text-gray-800 transition-colors duration-300">
                    Apply Now
                </x-forms.button2>
            @endcan
        </div>
    </div>
</x-panel>
