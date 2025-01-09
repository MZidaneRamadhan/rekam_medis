<aside class="sticky top-0 flex flex-col flex-shrink-0 w-64 h-screen overflow-y-auto bg-gray-100 shadow-2xl ">
    <div class="flex items-center justify-center p-4 text-lg font-medium text-center">
        <img src="{{ asset('Logo.png') }}" alt="" class="w-[50px] h-[50px]">
        <p class="text-xl">Medical Report</p>
    </div>
    {{-- <div class="p-4 text-lg font-bold">Dashboard</div> --}}
    {{-- <div class="px-4 text-lg font-bold">{{ Auth::user()->name }}</div> --}}
    <nav class="flex flex-col flex-grow mt-4">
        <div class="px-4 text-lg font-medium">Menu</div>
        <ul class="ml-4 ">
            <li
                class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                        {{ Route::currentRouteName() == 'dashboard' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                <a href="{{ route('dashboard') }}" class="block">
                    <i class="mr-3 fas fa-house"></i>Dashboard
                </a>
            </li>
            @if (auth()->user()->role == 'admin')
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                    {{ Route::currentRouteName() == 'user' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('user') }}" class="block">
                        <i class="mr-3 fas fa-user"></i>User
                    </a>
                </li>

                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                    {{ Route::currentRouteName() == 'dashboard.dokter.index' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('dashboard.dokter.index') }}" class="block">
                        <i class="mr-3 fas fa-user-doctor"></i>Dokter
                    </a>
                </li>
            @endif

            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'resepsionis' || auth()->user()->role == 'dokter')
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                            {{ Route::currentRouteName() == 'dashboard.pasien.index' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('dashboard.pasien.index') }}" class="block">
                        <i class="mr-3 fas fa-users"></i>Pasien
                    </a>
                </li>
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                        {{ Route::currentRouteName() == 'dashboard.rekammedis.index' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('dashboard.rekammedis.index') }}" class="block">
                        <i class="mr-3 fas fa-notes-medical"></i>Rekam Medis</a>
                </li>
            @endif
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'resepsionis')
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                    {{ Route::currentRouteName() == 'dashboard.kunjungan.index' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('dashboard.kunjungan.index') }}" class="block">
                        <i class="mr-3 fas fa-building"></i>Kunjungan
                    </a>
                </li>
            @endif

            @if (auth()->user()->role == 'dokter')
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                            {{ Route::currentRouteName() == 'antrianPasien' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('antrianPasien') }}" class="block">
                        <i class="mr-3 fas fa-people-roof"></i>Antrian Pasien
                    </a>
                    {{-- @if ($antrianCount > 0)
                        <span
                            class="absolute top-5 animate-pulse grid min-h-[28px] min-w-[28px] translate-x-44 -translate-y-2/4 place-items-center rounded-full bg-red-600 py-1 px-1 text-xs text-white border border-white">
                            {{ $antrianCount }}
                        </span>
                    @endif --}}
                </li>
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                        {{ Route::currentRouteName() == 'waitedLab' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('waitedLab') }}" class="block">
                        <i class="mr-3 fas fa-vial"></i>AntrianLab</a>
                </li>
            @endif

            @if (auth()->user()->role == 'apoteker')
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                    {{ Route::currentRouteName() == 'penyerahan' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('penyerahan') }}" class="block">
                        <i class="mr-3 fas fa-people-roof"></i>Penyerahan
                        Obat
                    </a>
                </li>
            @endif

            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'apoteker')
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                    {{ Route::currentRouteName() == 'dashboard.obat.index' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('dashboard.obat.index') }}" class="block">
                        <i class="mr-3 fas fa-pills"></i>Obat
                    </a>
                </li>
            @endif

            @if (auth()->user()->role == 'admin')
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                    {{ Route::currentRouteName() == 'dashboard.tindakan.index' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('dashboard.tindakan.index') }}" class="block">
                        <i class="mr-3 fas fa-briefcase-medical"></i>Tindakan
                    </a>
                </li>
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                    {{ Route::currentRouteName() == 'dashboard.poli.index' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('dashboard.poli.index') }}" class="block"><i
                            class="mr-3 fas fa-house-medical"></i>Poli
                    </a>
                </li>
            @endif

            @if (auth()->user()->role == 'lab')
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                {{ Route::currentRouteName() == 'lab' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('lab') }}" class="block">
                        <i class="mr-3 fas fa-microscope"></i>Labolatorium
                    </a>
                </li>
                <li
                    class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200
                {{ Route::currentRouteName() == 'lab.permintaan' ? 'bg-gray-200 border-r-blue-500 border-r-2' : '' }}">
                    <a href="{{ route('lab.permintaan') }}" class="block"><i class="mr-3 fas fa-vial"></i>Penanganan
                        Lab
                    </a>
                </li>
            @endif
        </ul>
    </nav>

    <div class="my-4 ml-4 text-sm">
        <div
            class="px-4 py-2 transition rounded-l-lg hover:bg-gray-300 hover:border-r-blue-500 hover:border-r-2 hover:ease-in-out hover:duration-200">
            <button type="submit" class="" data-dialog-target="dialog-logout">
                <i class="mr-2 fas fa-right-from-bracket"></i> Logout
            </button>
        </div>
    </div>

    <div data-dialog-backdrop="dialog-logout" data-dialog-backdrop-close="true"
        class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 backdrop-blur-sm opacity-0 transition-opacity duration-300">
        <div data-dialog="dialog-logout" class="absolute w-1/5 p-4 m-4 bg-white rounded-lg shadow-sm backdrop-blur-sm">
            <div class="flex items-center pb-4 text-xl font-medium shrink-0 text-slate-800">
                Logout Confirmation
            </div>
            <div class="relative py-4 font-light leading-normal border-t border-slate-200 text-slate-600">
                <form action="/logout" method="POST">
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
    </div>
    <div class="py-4 mx-4 text-sm font-light border-t border-t-slate-300">
        <a href="#" class="block hover:underline">About</a>
        <a href="#" class="block hover:underline">Help</a>
        <a href="#" class="block hover:underline">Version 1.0.0</a>
    </div>
</aside>
