<div id="custom-modal" class="relative z-10 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Background overlay -->
    <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75"></div>

    <!-- Modal container -->
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-full p-4 text-center sm:p-0">
            <div
                class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg">
                <!-- Modal Header -->
                <div class="flex items-center justify-between px-4 py-3 bg-gray-100">
                    <h2 id="modal-title" class="text-lg font-medium text-gray-900">Modal Title</h2>
                    <button type="button" class="text-gray-400 hover:text-gray-500" onclick="closeModal()">
                        <span class="sr-only">Close</span>
                        <!-- X icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Modal Body -->
                <div class="px-4 py-5 bg-white sm:p-6">
                    <p class="text-gray-500">This is the content of the modal. You can customize it as
                        needed.</p>
                </div>
                <!-- Modal Footer -->
                <div class="px-4 py-3 bg-gray-100 sm:flex sm:flex-row-reverse">
                    <button type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 sm:ml-3 sm:w-auto sm:text-sm">
                        Confirm
                    </button>
                    <button type="button"
                        class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 sm:mt-0 sm:w-auto sm:text-sm"
                        onclick="closeModal()">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>