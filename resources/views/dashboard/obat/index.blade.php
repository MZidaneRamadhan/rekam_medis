@extends('layouts.app')

@section('title', 'Obat')

@section('header', 'Obat Overview')

@section('content')
    <div>
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div>
            <h3 class="p-4 text-2xl font-medium">Data Obat</h3>
        </div>
        <div class="p-4 mb-10 bg-white border-t-2 rounded-md shadow-xl border-t-indigo-400">
            @if (Auth::user()->role == 'apoteker')
                <button data-dialog-target="dialog-xs"
                    class="px-4 py-2 mb-3 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button">
                    <i class="fas fa-plus"></i>Tambah Data Obat
                </button>
            @endif
            <div data-dialog-backdrop="dialog-xs" data-dialog-backdrop-close="true"
                class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
                <div data-dialog="dialog-xs" class="relative w-1/4 p-4 m-4 bg-white rounded-lg shadow-sm">
                    <div class="flex items-center pb-4 text-xl font-medium shrink-0 text-slate-800">Tambah Data Obat </div>
                    <div class="relative py-4 font-light leading-normal border-t border-slate-200 text-slate-600">
                        <form action="/obat-store" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Obat</label>
                                <input type="text" name="nama_obat" placeholder="Nama Obat"
                                    value="{{ old('nama_obat') }}"
                                    class="w-full px-4 py-2 text-sm text-gray-900 border  rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('nama_obat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                                    required />
                                @error('nama_obat')
                                    <p class="mt-1 text-sm text-red-500">Obat sudah di tambahkan masukan data obat
                                        yang lain</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">Harga</label>
                                <input name="harga" placeholder="Harga" value="{{ old('harga') }}"
                                    class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                    required />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">Jumlah</label>
                                <input name="jumlah_obat" placeholder="Jumlah" value="{{ old('jumlah_obat') }}"
                                    class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
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
                        <input type="text" id="searchInput" placeholder="Cari obat..." onkeyup="searchTable()"
                            class="w-full py-2 pl-3 pr-10 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-600 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" />
                        <i class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600 fas fa-search"> </i>
                    </div>
                </div>
                {{-- <input type="text" id="searchInput" placeholder="Cari obat..." onkeyup="searchTable()"
                class="w-1/6 px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" />
            --}}
            </div>
            <div class="overflow-x-auto rounded-lg shadow-md">
                <table id="sortableTable" class="w-full text-left bg-white rounded-t-lg">
                    <thead>
                        <tr class="text-white bg-gray-400">
                            <th class="px-4 py-2 font-light ">No</th>
                            <th class="px-4 py-2 font-light ">Nama Obat</th>
                            <th class="px-4 py-2 font-light ">Jumlah Obat</th>
                            <th class="px-4 py-2 font-light ">Harga</th>
                            @if (Auth::user()->role == 'apoteker')
                                <th class="px-4 py-2 font-light text-center">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @if ($obat->isEmpty())
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                                    Data belum ada
                                </td>
                            </tr>
                        @else
                            @foreach ($obat as $i => $p)
                                <tr class="border-b border-gray-200 py- even:hover:bg-gray-200 hover:bg-gray-100">
                                    <td class="px-4 py-2 ">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2 ">{{ $p->nama_obat }}</td>
                                    <td class="px-4 py-2 ">{{ $p->jumlah_obat }}</td>
                                    <td class="px-4 py-2 ">Rp. {{ number_format($p->harga, 0, ',', '.') }}</td>
                                    @if (Auth::user()->role == 'apoteker')
                                        <td class="flex items-center justify-center px-4 py-2 text-center">
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
                                                        Edit Data Obat </div>
                                                    <div
                                                        class="relative py-4 font-light leading-normal border-t text-start border-slate-200 text-slate-600">
                                                        <form action="/obat/{{ $p->id }}/update" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-4">
                                                                <label
                                                                    class="block mb-1 text-sm font-medium text-gray-700">Nama
                                                                    Obat</label>
                                                                <input type="text" name="nama_obat"
                                                                    placeholder="Nama Obat"
                                                                    value="{{ old('nama_obat', $p->nama_obat) }}"
                                                                    class="w-full px-4 py-2 text-sm text-gray-900 border  rounded-lg focus:ring-blue-500 focus:border-blue-500 @error('nama_obat') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                                                                    required />
                                                                @error('nama_obat')
                                                                    <p class="mt-1 text-sm text-red-500">Obat sudah di tambahkan
                                                                        masukan data obat
                                                                        yang lain</p>
                                                                @enderror
                                                            </div>
                                                            <div class="mb-4">
                                                                <label
                                                                    class="block mb-1 text-sm font-medium text-gray-700">Harga</label>
                                                                <input name="harga" placeholder="Harga"
                                                                    value="{{ old('harga', $p->harga) }}"
                                                                    class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                                                    required />
                                                            </div>
                                                            <div class="mb-4">
                                                                <label
                                                                    class="block mb-1 text-sm font-medium text-gray-700">Jumlah</label>
                                                                <input name="jumlah_obat" placeholder="Jumlah"
                                                                    value="{{ old('jumlah_obat', $p->jumlah_obat) }}"
                                                                    class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                                                    required />
                                                            </div>
                                                            <div
                                                                class="flex flex-wrap items-center justify-end pt-4 shrink-0">
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
                                            <div id="edit-modal" class="relative z-10 hidden">
                                                <div
                                                    class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 backdrop-blur-sm">
                                                </div>
                                                <div class="fixed inset-0 z-10 overflow-y-auto">
                                                    <div
                                                        class="flex items-center justify-center min-h-full p-4 text-center sm:p-0">
                                                        <div
                                                            class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg">
                                                            <div
                                                                class="flex items-center justify-between px-4 py-3 bg-gray-100">
                                                                <h2 class="text-lg font-medium text-gray-900">Edit Data
                                                                    Obat
                                                                </h2>
                                                                <button type="button"
                                                                    class="text-xl text-gray-400 hover:text-gray-500"
                                                                    onclick="closeModalEdit()">
                                                                    &times;
                                                                </button>
                                                            </div>
                                                            <div class="bg-white ">
                                                                <form action="/obat/{{ $p->id }}/update"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="px-4 py-5 sm:p-6">
                                                                        <input type="hidden" id="modal-id"
                                                                            name="id">
                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block mb-1 text-sm font-medium text-gray-700">Nama
                                                                                Obat</label>
                                                                            <input type="text" id="nama_obat"
                                                                                name="nama_obat" placeholder="Nama Obat"
                                                                                class="w-full px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                                                                required />
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block mb-1 text-sm font-medium text-gray-700">Harga</label>
                                                                            <input type="number" id="harga"
                                                                                name="harga" placeholder="Harga"
                                                                                class="w-full px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                                                                required />
                                                                        </div>
                                                                        <div class="mb-4">
                                                                            <label
                                                                                class="block mb-1 text-sm font-medium text-gray-700">Jumlah</label>
                                                                            <input type="string" id="jumlah_obat"
                                                                                name="jumlah_obat" placeholder="Jumlah"
                                                                                class="w-full px-4 py-2 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                                                                required />
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="gap-2 px-4 py-3 bg-gray-100 sm:flex sm:flex-row-reverse">
                                                                        <button
                                                                            class="px-4 py-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                                            type="submit">
                                                                            Simpan Perubahan
                                                                        </button>
                                                                        <button onclick="closeModalEdit()" type="button"
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
                                            <button onclick="modalDelete('{{ route('obat.delete', $p->id) }}')"
                                                class="relative px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-red-600 border border-transparent rounded-md shadow-md group hover:shadow-lg hover:shadow-red-200 focus:bg-red-600 focus:shadow-none active:bg-red-800 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="items-center justify-center fas fa-trash"></i> Hapus
                                            </button>
                                            @include('components.modal-delete', ['deleteUrl' => ''])
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="my-4">
                {{ $obat->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });
        </script>
    @endif
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

        function openModal() {
            const modal = document.getElementById('custom-modal');
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('custom-modal');
            modal.classList.add('hidden');
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

        function openModalEdit(id, nama_obat, harga, jumlah_obat) {

            document.getElementById('modal-id').value = id;
            document.getElementById('nama_obat').value = nama_obat;
            document.getElementById('harga').value = harga;
            document.getElementById('jumlah_obat').value = jumlah_obat;
            document.getElementById('edit-modal').classList.remove('hidden');
        }

        function closeModalEdit() {
            document.getElementById('edit-modal').classList.add('hidden');
        }
    </script>
@endsection
