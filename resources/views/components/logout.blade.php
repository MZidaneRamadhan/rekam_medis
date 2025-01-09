<div id="logout" class="relative z-10 hidden">
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
                    <form action="/logout" method="POST">
                        @csrf
                        <div class="flex items-center justify-center px-4 py-3 bg-gray-100">
                            <h2 class="text-2xl font-medium text-gray-900">Yakin Ingin Logout?</h2>
                        </div>
                        <div class="flex justify-center gap-2 px-4 py-3 bg-gray-100">
                            <button
                                class="px-4 py-2 text-sm text-center text-white transition-all bg-red-600 border border-transparent rounded-md shadow-md hover:shadow-lg focus:bg-red-700 focus:shadow-none active:bg-red-700 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                type="submit">Logout
                            </button>
                            <button onclick="closeLogout()" type="button"
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