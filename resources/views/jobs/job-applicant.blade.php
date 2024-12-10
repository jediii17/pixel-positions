<x-layout>
    <x-page-heading>Applicants for {{ $job->title }}</x-page-heading>

    <div class="mb-6">
        <h2 class="text-lg font-bold">{{ $job->title }}</h2>
        <p class="text-sm text-gray-600">Salary: {{ $job->salary }}</p>
        <p class="text-sm text-gray-600">Location: {{ $job->location }}</p>
        <p class="text-sm text-gray-600">Schedule: {{ $job->schedule }}</p>
    </div>

    <div class="mt-6 mx-auto w-full max-w-5x">
    
        <div class="mb-6">
            <x-forms.success>
                {{ session('success') }}
            </x-forms.success>

            <x-forms.error>
                {{ session('error') }}
            </x-forms.error>
        </div>

        <div class="overflow-hidden bg-white/90 px-5 py-5 rounded-lg">
            <table class="font-inter w-full table-auto border-separate border-spacing-y-1 text-left">
                <thead class="rounded-xl bg-[#222E3A]/[6%] font-bold">
                    <tr class="text-black">
                        <th class="whitespace-nowrap rounded-l-lg py-3 pl-3 text-sm font-normal">Candidate's Name</th>
                        <th class="whitespace-nowrap py-3 pl-1 text-sm font-normal">Date Applied</th>
                        <th class="whitespace-nowrap py-3 pl-4 text-sm font-normal">Resume</th>
                        <th class="whitespace-nowrap rounded-r-lg py-3 pl-1 text-sm font-normal">Job Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($job->applications as $application)
                        <tr class="cursor-pointer bg-[#f6f8fa] drop-shadow-[0_0_10px_rgba(34,46,58,0.02)] hover:shadow-2xl">
                            <td class="rounded-l-lg py-4 pl-3 text-sm font-normal text-[#637381]">{{ $application->user->name }}</td>
                            <td class="px-1 py-4 text-sm font-normal text-[#637381]">{{ $application->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2 text-[#637381]">
                                <a href="{{ asset('storage/' . $application->resume) }}" target="_blank" class="text-blue-500">
                                    View Resume
                                </a>
                            </td>
                            <td class="px-4 py-2 rounded-r-lg text-[#637381]">
                                <form 
                                    action="{{ route('job-applications.status', $application->id) }}" 
                                    method="POST"
                                >
                                    @csrf
                                    @method('PATCH')
                                    <select 
                                        name="status" 
                                        class="form-select text-sm" 
                                        onchange="this.form.submit()"
                                    >
                                        <option value="Pending" {{ $application->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Accepted" {{ $application->status === 'Accepted' ? 'selected' : '' }}>Accepted</option>
                                        <option value="Declined" {{ $application->status === 'Declined' ? 'selected' : '' }}>Declined</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">No applicants yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
