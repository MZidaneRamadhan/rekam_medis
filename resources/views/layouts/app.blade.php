<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.0/css/dataTables.tailwindcss.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>@yield('title', 'Dashboard') | Medical Record </title>
</head>

<body class="bg-slate-50">
    <div class="flex min-h-screen">
        @include('components.sidebar')
        <main class="flex-grow">
            <header class="flex items-center justify-between p-3 mb-6 bg-white shadow-xl px-7 ">
                <button>
                    <i class="text-2xl fas fa-bars "></i>
                </button>
                {{-- <h1 class="text-2xl font-bold text-gray-700">@yield('header', 'Welcome')</h1> --}}
                <div class="flex flex-col">
                    <h1 class="text-lg font-bold text-gray-700">{{ Auth::user()->name }}</h1>
                    @if (Auth::user()->role == 'dokter')
                        <h1 class="text-xs font-bold text-gray-700 capitalize">
                            {{ Auth::user()->role }} {{ Auth::user()->dokter->poli->nama_poli }}
                        </h1>
                    @else
                        <h1 class="text-xs font-bold text-gray-700 capitalize">
                            {{ Auth::user()->role }}
                        </h1>
                    @endif
                </div>
            </header>
            <section class="px-6 ">
                <!-- Modal Include -->
                @yield('content')
            </section>
        </main>
    </div>
    @if (auth()->check())
    @else
        <script>
            window.location = "{{ route('login') }}";
        </script>
    @endif
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/dialog.js"></script>
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/ripple.js"></script>
    <script type="module" src="https://unpkg.com/@material-tailwind/html@latest/scripts/tooltip.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/tabs.js"></script>
    @include('sweetalert::alert')
    @yield('scripts')

</body>

</html>
