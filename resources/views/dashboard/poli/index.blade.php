@extends('layouts.app')

@section('title', 'Poli')

@section('header', 'Poli Overview')

@section('content')
    <div class="">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <h3 class="p-4 text-2xl font-medium">Data Pasien</h3>
        <div class="p-4 bg-white border-t-2 rounded-md shadow-xl border-t-indigo-400">
            <button data-dialog-target="dialog-xs"
                class="px-4 py-2 mb-3 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
                <i class="fas fa-plus"></i>Tambah Data Poli
            </button>
            <div data-dialog-backdrop="dialog-xs" data-dialog-backdrop-close="true"
                class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
                <div data-dialog="dialog-xs" class="relative w-1/4 p-4 m-4 bg-white rounded-lg shadow-sm">
                    <div class="flex items-center pb-4 text-xl font-medium shrink-0 text-slate-800">Tambah Data Poli </div>
                    <div class="relative py-4 font-light leading-normal border-t border-slate-200 text-slate-600">
                        <form action="/poli-store" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">Poli</label>
                                <input type="text" name="nama_poli" id="nama_poli" placeholder="Poli"
                                    class="w-full px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    required />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">Ruangan</label>
                                <input name="ruangan" id="ruangan" placeholder="Ruangan"
                                    class="w-full px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                    required />
                            </div>
                            <div class="flex flex-wrap items-center justify-end pt-4 shrink-0">
                                <button data-dialog-close="true"
                                    class="px-4 py-2 text-sm text-center transition-all border border-transparent rounded-md text-slate-600 hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    Cancel
                                </button>
                                <button data-dialog-close="true"
                                    class="px-4 py-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="sumbit">
                                    Confirm
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="w-full max-w-sm min-w-[200px]">
                    <div class="relative">
                        <input type="text" id="searchInput" placeholder="Cari poli..." onkeyup="searchTable()"
                            class="w-full py-2 pl-3 pr-10 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-600 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" />
                        <i class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600 fas fa-search"> </i>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto rounded-lg shadow-md">
                <table id="sortableTable" class="w-full text-left bg-white">
                    <thead>
                        <tr class="text-white bg-gray-400 ">
                            <th class="px-4 py-2 font-light cursor-pointer" onclick="sortTable(0)">#</th>
                            <th class="px-4 py-2 font-light cursor-pointer" onclick="sortTable(1)">Poli</th>
                            <th class="px-4 py-2 font-light cursor-pointer" onclick="sortTable(2)">Ruangan</th>
                            <th class="px-4 py-2 font-light text-center ">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($poli->isEmpty())
                            <tr>
                                <td colspan=" 6" class="px-4 py-2 text-xl text-center text-gray-600">
                                    Data belum ada
                                </td>
                            </tr>
                        @else
                            @foreach ($poli as $i => $p)
                                <tr class="border-b border-gray-200 even:hover:bg-gray-200 hover:bg-gray-100">
                                    <td class="px-4 py-2 ">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2 ">{{ $p->nama_poli }}</td>
                                    <td class="px-4 py-2 ">{{ $p->ruangan }}</td>
                                    <td class="flex items-center justify-center px-2 py-2 text-center">
                                        <button data-dialog-target="dialog-edit{{ $p->id }}"
                                            class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-blue-200 focus:bg-blue-600 focus:shadow-none active:bg-blue-800 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="items-center justify-center fas fa-edit"></i> Edit
                                        </button>
                                        {{-- Modal Edit --}}
                                        <div data-dialog-backdrop="dialog-edit{{ $p->id }}"
                                            data-dialog-backdrop-close="true"
                                            class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
                                            <div data-dialog="dialog-edit{{ $p->id }}"
                                                class="relative w-1/4 p-4 m-4 bg-white rounded-lg shadow-sm">
                                                <div class="flex items-center pb-4 text-xl font-medium text-slate-800">
                                                    Edit Data Poli
                                                </div>
                                                <div
                                                    class="relative py-4 font-light leading-normal border-t text-start border-slate-200 text-slate-600">
                                                    <form action="poli/{{ $p->id }}/update" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-4">
                                                            <label class="block mb-1 text-sm font-medium text-gray-700">Nama
                                                                Poli</label>
                                                            <input type="text" name="nama_poli" placeholder="Nama Poli"
                                                                value="{{ old('nama_poli', $p->nama_poli) }}"
                                                                class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow @error('nama_poli') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                                                                required />
                                                            @error('nama_poli')
                                                                <p class="mt-1 text-sm text-red-500">
                                                                    Poli sudah ditambahkan, masukkan data tindakan yang lain
                                                                </p>
                                                            @enderror
                                                        </div>
                                                        <div class="mb-4">
                                                            <label
                                                                class="block mb-1 text-sm font-medium text-gray-700">Ruangan</label>
                                                            <textarea name="ruangan" placeholder="Ruangan"
                                                                class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                                                required>{{ old('ruangan', $p->ruangan) }}</textarea>
                                                        </div>
                                                        <div class="flex flex-wrap items-center justify-end pt-4 shrink-0">
                                                            <button data-dialog-close="true"
                                                                class="px-4 py-2 text-sm text-center transition-all border border-transparent rounded-md text-slate-600 hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                                type="button" onclick="closeEditModal()">
                                                                Cancel
                                                            </button>
                                                            <button data-dialog-close="true"
                                                                class="px-4 py-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-blue-200 focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                                type="submit">
                                                                Update
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <button onclick="modalDelete('{{ route('poli.delete', $p->id) }}')"
                                            class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-red-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-red-200 focus:bg-red-600 focus:shadow-none active:bg-red-800 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="items-center justify-center fas fa-trash"></i> Hapus
                                        </button>
                                        @include('components.modal-delete', ['deleteUrl' => ''])
                                        {{-- <button data-dialog-backdrop="dialog-logout{{ $p->$id }}"
                                class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-red-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-red-200 focus:bg-red-600 focus:shadow-none active:bg-red-800 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                <i class="items-center justify-center fas fa-trash"></i> Hapus
                            </button>
                            @include('components.modal-delete', ['deleteUrl' => '','id' => '']) --}}
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
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
    </div>
@endsection
@section('scripts')
    <script>
        function sortTable(columnIndex) {
            const table = document.getElementById("sortableTable");
            const tbody = table.tBodies[0];
            const rows = Array.from(tbody.querySelectorAll("tr"));

            const currentDirection = table.dataset.sortDirection || "asc";
            const newDirection = currentDirection === "asc" ? "desc" : "asc";
            table.dataset.sortDirection = newDirection;

            rows.sort((a, b) => {
                const cellA = a.cells[columnIndex].textContent.trim();
                const cellB = b.cells[columnIndex].textContent.trim();

                if (!isNaN(cellA) && !isNaN(cellB)) {
                    return newDirection === "asc" ? cellA - cellB : cellB - cellA;
                } else {
                    return newDirection === "asc" ? cellA.localeCompare(cellB) : cellB.localeCompare(cellA);
                }
            });
            rows.forEach(row => tbody.appendChild(row));
        }

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
