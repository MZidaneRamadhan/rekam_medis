@extends('layouts.app')

@section('title', 'Dokter')

@section('header', 'Dokter Overview')

@section('content')
    <div class="w-full">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div>
            <h3 class="p-4 text-2xl font-medium">Data Dokter</h3>
        </div>
        <div class="p-4 bg-white border-t-2 rounded-md shadow-xl border-t-indigo-400">
            <button data-dialog-target="dialog-xs"
                class="px-4 py-2 mb-3 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md shadow-blue-300 hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                type="button">
                +Tambah Data Dokter
            </button>
            <div data-dialog-backdrop="dialog-xs" data-dialog-backdrop-close="true"
                class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
                <div data-dialog="dialog-xs" class="relative w-1/4 p-4 m-4 bg-white rounded-lg shadow-sm">
                    <div class="flex items-center pb-4 text-xl font-medium shrink-0 text-slate-800">Tambah Data Dokter
                    </div>
                    <div class="relative py-4 font-light leading-normal border-t border-slate-200 text-slate-600">
                        <form action="/dokter-store" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">Nama Dokter</label>
                                <input type="text" name="name" placeholder="Nama Dokter" value="{{ old('name') }}"
                                    class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-300 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow @error('name') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                                    required />
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">Obat sudah di tambahkan masukan data obat
                                        yang lain</p>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">Email</label>
                                <input name="email" value="{{ old('email') }}" placeholder="Email"
                                    class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                    required />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">Password</label>
                                <input name="password" value="{{ old('password') }}" placeholder="Password"
                                    class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                    required />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">Poli Tujuan</label>
                                <div class="w-full max-w-sm min-w-[200px] ">
                                    <div class="relative">
                                        <select name="poli_id"
                                            class="w-full py-2 pl-3 pr-8 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm appearance-none cursor-pointer placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 focus:shadow-md">
                                            <option selected disabled>-- Pilih Poli --</option>
                                            @foreach ($poli as $p)
                                                <option value="{{ $p->id }}">{{ $p->nama_poli }}</option>
                                            @endforeach
                                        </select>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.2" stroke="currentColor"
                                            class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">SIP</label>
                                <input name="SIP" value="{{ old('SIP') }}" placeholder="SIP"
                                    class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                    required />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">No Telepon</label>
                                <input name="telp" value="{{ old('telp') }}" placeholder="No Telepon"
                                    class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                    required />
                            </div>
                            <div class="mb-4">
                                <label class="block mb-1 text-sm font-medium text-gray-700">Alamat</label>
                                <input name="alamat" value="{{ old('alamat') }}" placeholder="Alamat"
                                    class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                    required />
                            </div>
                            <div class="flex flex-wrap items-center justify-end pt-4 shrink-0">
                                <button data-dialog-close="true"
                                    class="px-4 py-2 text-sm text-center transition-all border border-transparent rounded-md text-slate-600 hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100 disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                    type="button">
                                    Cancel
                                </button>
                                <button data-dialog-close="true"
                                    class="px-4 py-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
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
                        <input type="text" id="searchInput" placeholder="Cari dokter..." onkeyup="searchTable()"
                            class="w-full py-2 pl-3 pr-10 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-600 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" />
                        <i class="absolute w-5 h-5 top-2.5 right-2.5 text-slate-600 fas fa-search"> </i>
                    </div>
                </div>
            </div>
            <div class="overflow-x-auto rounded-md shadow-md ">
                <table id="sortableTable" class="w-full text-sm text-left bg-white rounded-t-lg">
                    <thead>
                        <tr class="text-white bg-gray-400">
                            <th class="px-4 py-2 ">No</th>
                            <th class="px-4 py-2 ">Nama</th>
                            <th class="px-4 py-2 ">Poli</th>
                            <th class="px-4 py-2 ">Nomor Telepon</th>
                            <th class="px-4 py-2 ">Alamat</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($dokter->isEmpty())
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                                    Data belum ada
                                </td>
                            </tr>
                        @else
                            @foreach ($dokter as $i => $p)
                                <tr class="border-b border-gray-200 even:hover:bg-gray-200 hover:bg-gray-100">
                                    <td class="px-4 py-2 ">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2 ">{{ $p->nama_dokter }}</td>
                                    <td class="px-4 py-2 ">{{ $p->poli->nama_poli }}</td>
                                    <td class="px-4 py-2 ">{{ $p->telp }}</td>
                                    <td class="px-4 py-2 ">{{ $p->alamat }}</td>
                                    <td class="flex items-center justify-center px-4 py-2 text-center">
                                        <a href="/dokter/{{ $p->id }}/details"
                                            class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-blue-200 focus:bg-blue-600 focus:shadow-none active:bg-blue-800 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="items-center justify-center fas fa-file-lines"></i>
                                        </a>
                                        <button data-dialog-target="dialog-edit{{ $p->id }}"
                                            class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-blue-200 focus:bg-blue-600 focus:shadow-none active:bg-blue-800 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="items-center justify-center fas fa-edit"></i> Edit
                                        </button>
                                        <div data-dialog-backdrop="dialog-edit{{ $p->id }}"
                                            data-dialog-backdrop-close="true"
                                            class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
                                            <div data-dialog="dialog-edit{{ $p->id }}"
                                                class="relative w-1/4 p-4 m-4 bg-white rounded-lg shadow-sm">
                                                <div class="flex items-center pb-4 text-xl font-medium text-slate-800">
                                                    Edit Data Dokter
                                                </div>
                                                <div
                                                    class="relative py-4 font-light leading-normal border-t text-start border-slate-200 text-slate-600">
                                                    <form action="dokter/{{ $p->id }}/update" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-4">
                                                            <label
                                                                class="block mb-1 text-sm font-medium text-gray-700">Nama
                                                                Dokter</label>
                                                            <input type="text" name="nama_dokter"
                                                                placeholder="Nama Poli"
                                                                value="{{ old('nama_dokter', $p->nama_dokter) }}"
                                                                class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow @error('nama_poli') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                                                                required />
                                                        </div>
                                                        <div class="mb-4">
                                                            <label
                                                                class="block mb-1 text-sm font-medium text-gray-700">SIP</label>
                                                            <textarea name="SIP" placeholder="SIP"
                                                                class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                                                required>{{ old('SIP', $p->SIP) }}</textarea>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block mb-1 text-sm font-medium text-gray-700">No
                                                                Telepon</label>
                                                            <textarea name="telp" placeholder="No Telepon"
                                                                class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                                                required>{{ old('telp', $p->telp) }}</textarea>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label
                                                                class="block mb-1 text-sm font-medium text-gray-700">alamat</label>
                                                            <textarea name="alamat" placeholder="alamat"
                                                                class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                                                required>{{ old('alamat', $p->alamat) }}</textarea>
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

                                        <button onclick="modalDelete('{{ route('dokter.delete', $p->id) }}')"
                                            class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-red-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-red-200 focus:bg-red-600 focus:shadow-none active:bg-red-800 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="items-center justify-center fas fa-trash"></i> Hapus
                                        </button>
                                        @include('components.modal-delete', ['deleteUrl' => ''])
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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

        function openModal() {
            const modal = document.getElementById('custom-modal');
            modal.classList.remove('hidden');
        }

        function closeModal() {
            const modal = document.getElementById('custom-modal');
            modal.classList.add('hidden');
        }
    </script>
@endsection
