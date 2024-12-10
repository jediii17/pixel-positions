<x-layout>
    <x-page-heading>Your Applied Jobs</x-page-heading>

    <div class="space-y-4 mt-8">
        @forelse ($applications as $application)
            <div class="p-4 border rounded shadow flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-lg">{{ $application->job->title }}</h3>
                    <p class="text-sm text-gray-600">Company: {{ $application->job->employer->name }}</p>
                    <p class="text-sm text-gray-600">Applied on: {{ $application->created_at->format('F j, Y') }}</p>
                </div>
                <span class="px-3 py-1 text-sm font-bold rounded 
                    {{ $application->status === 'Accepted' ? 'text-green-600 bg-green-100' : ($application->status === 'Declined' ? 'text-red-600 bg-red-100' : 'text-gray-600 bg-gray-100') }}">
                    {{ $application->status }}
                </span>
            </div>
        @empty
            <p class="text-gray-500 text-center">You haven't applied for any jobs yet.</p>
        @endforelse
    </div>
</x-layout>
