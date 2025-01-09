{{-- <div data-dialog-backdrop="dialog-logout{{ $id }}" data-dialog-backdrop-close="true"
    class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    <div data-dialog="dialog-logout" class="relative w-1/5 p-4 m-4 bg-white rounded-lg shadow-sm backdrop-blur-sm">
        <div class="flex items-center pb-4 text-xl font-medium shrink-0 text-slate-800">
            Logout Confirmation
        </div>
        <div class="relative py-4 font-light leading-normal border-t border-slate-200 text-slate-600">
            <form action="{{ $deleteUrl }}" method="POST">
                @csrf
                <div class="relative py-4 text-xl font-light leading-normal text-center text-slate-600">
                    Are you sure you want to logout?
                </div>
                <div class="flex flex-wrap items-center justify-center pt-4 ">
                    <button data-dialog-close="true"
                        class="px-4 py-2 text-sm text-center transition-all border border-transparent rounded-md text-slate-600 hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="button">
                        Cancel
                    </button>
                    <button data-dialog-close="true"
                        class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-red-600 border border-transparent rounded-md shadow-md hover:shadow-lg focus:bg-red-700 focus:shadow-none active:bg-red-700 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                        type="submit">
                        Confirm
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> --}}


<div id="modalDelete" class="relative z-10 hidden">
    <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 backdrop-blur-sm">
    </div>
    <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-full p-4 text-center sm:p-0">
            <div
                class="relative overflow-hidden text-left transition-all transform bg-gray-100 rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg">

                <div class="flex justify-center mt-4">
                    <i class="text-red-600 text-9xl fas fa-exclamation-circle"></i>
                </div>
                <div class="mt-4 ">
                    <form action="{{ $deleteUrl }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="flex items-center justify-center px-4 py-3 bg-gray-100">
                            <h2 class="text-2xl font-medium text-gray-900">Yakin Ingin
                                Hapus Data?
                            </h2>
                        </div>
                        <div class="flex justify-center gap-2 px-4 py-3 bg-gray-100">
                            <button
                                class="px-4 py-2 text-sm text-center text-white transition-all bg-red-600 border border-transparent rounded-md shadow-md hover:shadow-lg focus:bg-red-700 focus:shadow-none active:bg-red-700 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="submit">Hapus
                            </button>
                            <button onclick="closeDelete()" type="button"
                                class="px-4 py-2 text-sm text-center transition-all border rounded-md shadow-sm border-slate-300 hover:shadow-lg text-slate-600 hover:text-white hover:bg-slate-800 hover:border-slate-800 focus:text-white focus:bg-slate-800 focus:border-slate-800 active:border-slate-800 active:text-white active:bg-slate-800 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>