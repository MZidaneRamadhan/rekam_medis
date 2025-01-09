@extends('layouts.app')

@section('title', 'Rekam Medis')

@section('header', 'Rekam Medis Overview')

@section('content')
    <div class="">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div>
            <h3 class="p-4 text-2xl font-medium">Data Rekam Medis</h3>
        </div>
        <div class="p-4 bg-white border-t-2 rounded-md shadow-xl border-t-indigo-400">
            @if (!$rekam->isEmpty())
                @if (Auth::user()->role == 'admin')
                    <div class="flex justify-end gap-3 mb-4">
                        <a href="/report-rm" data-ripple-light="true" data-tooltip-target="print"
                            class="select-none rounded-lg bg-yellow-500 py-3 px-5 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-yellow-500/10 transition-all hover:shadow-lg hover:shadow-yellow-500/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            <i class="text-lg fas fa-print"></i>
                        </a>
                        <div data-tooltip="print"
                            class="absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                            Cetak Laporan
                        </div>
                        {{-- @foreach ($rekam as $i => $p) --}}
                        <a href="/report-rm-details" data-ripple-light="true" data-tooltip-target="print2"
                            class="select-none rounded-lg bg-yellow-500 py-3 px-5 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-yellow-500/10 transition-all hover:shadow-lg hover:shadow-yellow-500/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            <i class="text-lg fas fa-file-pdf"></i>
                        </a>
                        {{-- @endforeach --}}
                        <div data-tooltip="print2"
                            class="absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                            Cetak Laporan Detail
                        </div>
                        <button data-ripple-light="true" data-tooltip-target="ex"
                            class="select-none rounded-lg bg-green-500 py-3 px-5 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-green-500/10 transition-all hover:shadow-lg hover:shadow-green-500/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            <i class="text-lg fas fa-file-excel"></i>
                        </button>
                        <div data-tooltip="ex"
                            class="absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                            Cetak Laporan Detail
                        </div>
                    </div>
                @endif
            @endif
            <div class="mb-4">
                <div class="w-full max-w-sm min-w-[200px]">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari Rekam Medis..." onkeyup="searchTable()"
                            class="w-full py-2 pl-3 pr-10 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-600 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" />
                        <i class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600 fas fa-search"> </i>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto rounded-lg shadow-md">
                <table id="sortableTable" class="w-full text-sm text-left bg-white rounded-t-lg">
                    <thead>
                        <tr class="text-white bg-gray-400 ">
                            <th class="px-4 py-2 font-light ">No</th>
                            <th class="py-2 font-light ">Tanggal Pemeriksaan</th>
                            <th class="px-4 py-2 font-light ">No RM</th>
                            <th class="px-4 py-2 font-light ">NIK</th>
                            <th class="px-4 py-2 font-light ">Nama Pasien</th>
                            <th class="px-4 py-2 font-light ">Usia</th>
                            <th class="px-4 py-2 font-light ">Poli Tujuan</th>
                            <th class="px-4 py-2 font-light ">Nama Dokter</th>
                            <th class="px-4 py-2 font-light ">Status</th>
                            <th class="px-4 py-2 font-light text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rekam->isEmpty())
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-500">Data belum ada</td>
                            </tr>
                        @else
                            @foreach ($rekam as $i => $p)
                                <tr class="border-b border-gray-200 even:hover:bg-gray-200 hover:bg-gray-100">
                                    <td class="px-4 py-2 ">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2 ">{{ $p->tanggal_pemeriksaan }}</td>
                                    <td class="px-4 py-2 ">{{ $p->no_rm }}</td>
                                    <td class="px-4 py-2 ">{{ $p->pasien->nik }}</td>
                                    <td class="px-4 py-2 ">{{ $p->pasien->nama }}</td>
                                    <td class="px-4 py-2 ">{{ $p->pasien->usia_lengkap }}</td>
                                    <td class="px-4 py-2 ">{{ $p->dokter->poli->nama_poli }} </td>
                                    <td class="px-4 py-2 ">{{ $p->dokter->nama_dokter }}</td>
                                    <td class="px-2 py-2 ">
                                        @if ($p->status == 'Penyerahan Obat')
                                            <div
                                                class="inline-block px-3 py-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-amber-500">
                                                {{ $p->status }}
                                            </div>
                                        @else
                                            <div
                                                class="inline-block px-3 py-1 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm">
                                                {{ $p->status }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="flex items-center justify-center px-4 py-2 text-center">
                                        <a href="/rekam-medis/{{ $p->id }}/details" data-ripple-light="true"
                                            data-tooltip-target="detail"
                                            class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md group hover:shadow-lg hover:shadow-blue-200 focus:bg-blue-600 focus:shadow-none active:bg-blue-800 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="items-center justify-center fas fa-file-lines"></i>
                                            <div data-tooltip="detail"
                                                class="absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                                                Details Rekam Medis
                                            </div>
                                        </a>
                                        @if (Auth::user()->role == 'dokter')
                                            <a href="/rekam-medis/{{ $p->id }}/edit" data-ripple-light="true"
                                                data-tooltip-target="edit"
                                                class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-yellow-600 border border-transparent rounded-md shadow-md group hover:shadow-lg hover:shadow-yellow-200 focus:bg-yellow-600 focus:shadow-none active:bg-yellow-800 hover:bg-yellow-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="items-center justify-center fas fa-pen"></i>
                                                <div data-tooltip="edit"
                                                    class="absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                                                    Edit Data Rekam Medis
                                                </div>
                                            </a>
                                        @endif
                                        {{-- @if (Auth::user()->role == 'admin')
                                            <button onclick="modalDelete('{{ route('rekammedis.delete', $p->id) }}')"
                                                data-ripple-light="true" data-tooltip-target="tooltip"
                                                class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-red-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-red-200 focus:bg-red-600 focus:shadow-none active:bg-red-800 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="items-center justify-center fas fa-trash"></i>
                                            </button>
                                            <div data-tooltip="tooltip"
                                                class="absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                                                Hapus Data Rekam Medis
                                            </div>
                                            @include('components.modal-delete', ['deleteUrl' => ''])
                                        @else
                                        @endif --}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="my-4">
                {{ $rekam->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
@endsection
@section('scripts')
    <script>
        function searchTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toLowerCase();
            const table = document.getElementById("sortableTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    if (cells[j]) {
                        const cellValue = cells[j].textContent || cells[j].innerText;
                        if (cellValue.toLowerCase().indexOf(filter) > -1) {
                            match = true;
                            break;
                        }
                    }
                }
                rows[i].style.display = match ? "" : "none";
            }
        }

        function modalDelete(deleteUrl) {
            const modal = document.getElementById('modalDelete');
            modal.classList.remove('hidden');
            modal.querySelector('form').action = deleteUrl;
        }

        function closeDelete() {
            const modal = document.getElementById('modalDelete');
            modal.classList.add('hidden');
        }
    </script>
@endsection
