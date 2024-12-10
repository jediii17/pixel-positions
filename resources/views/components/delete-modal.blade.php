<div id="popup-modal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center w-full h-full bg-gray-900/80">
    <div class="relative p-4 w-full max-w-md max-h-full bg-white rounded-lg shadow dark:bg-gray-700">
        <!-- Close button at the top-right -->
        <button type="button" class="absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal" onclick="closeDeleteModal()">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>

        <!-- Modal Content -->
        <div class="p-4 md:p-5 text-center">
            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>

            <h3 id="modal-title" class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">title</h3>

            <form id="deleteForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-between mt-10 space-x-2">
                    <x-delete-button>Delete</x-delete-button>
                    <x-cancel-button onclick="closeDeleteModal()">Cancel</x-cancel-button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(jobId, title) {
        const modal = document.getElementById('popup-modal');
        const form = document.getElementById('deleteForm');
        const modalTitle = document.getElementById('modal-title');

        modalTitle.textContent = `Are you sure you want to delete the job: '${title}'?`;

        form.action = `/jobs/${jobId}`;

        modal.classList.remove('hidden');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('popup-modal');
        modal.classList.add('hidden');
    }
</script>
