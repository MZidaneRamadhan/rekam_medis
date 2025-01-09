@extends('layouts.app')

@section('title', 'Kunjungan')

@section('header', 'Kunjungan Overview')

@section('content')
    <div class="w-full">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div>
            <h3 class="p-4 text-2xl font-medium">Data Kunjungan</h3>
        </div>
        <div class="p-4 bg-white border-t-2 rounded-md shadow-xl border-t-indigo-400">

            {{-- <button onclick="openModal()"
            class="px-4 py-2 mb-3 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
            type="button">
            +Tambah Data Dokter
        </button> --}}
            <div id="custom-modal" class="relative z-10 {{ $errors->any() ? '' : 'hidden' }}">
                <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-75 backdrop-blur-sm"></div>
                <div class="fixed inset-0 z-10 overflow-y-auto">
                    <div class="flex items-center justify-center min-h-full p-4 text-center sm:p-0">
                        <div
                            class="relative overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:w-full sm:max-w-lg">
                            <div class="flex items-center justify-between px-4 py-3 bg-gray-100">
                                <h2 class="text-lg font-medium text-gray-900">Tambah Data Obat</h2>
                                <button type="button" class="text-xl text-gray-400 hover:text-gray-500"
                                    onclick="closeModal()">
                                    &times;
                                </button>
                            </div>
                            <div class="bg-white ">
                                <form action="/dokter-store" method="POST">
                                    @csrf
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="mb-4">
                                            <label class="block mb-1 text-sm font-medium text-gray-700">Nama Dokter</label>
                                            <input type="text" name="nama_dokter" placeholder="Nama Dokter"
                                                value="{{ old('nama_dokter') }}"
                                                class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-300 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow @error('nama_dokter') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                                                required />
                                            @error('nama_dokter')
                                                <p class="mt-1 text-sm text-red-500">Obat sudah di tambahkan masukan data obat
                                                    yang lain</p>
                                            @enderror
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
                                    </div>
                                    <div class="gap-2 px-4 py-3 bg-gray-100 sm:flex sm:flex-row-reverse">
                                        <button
                                            class="px-4 py-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                            type="submit">
                                            Tambah
                                        </button>
                                        <button type="button" onclick="closeModal()"
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
            <div class="overflow-x-auto rounded-md shadow-md ">
                <table id="users-table" class="w-full text-sm text-left bg-white rounded-t-lg">
                    <thead>
                        <tr class="text-white bg-gray-400">
                            <th class="px-4 py-2 ">No</th>
                            <th class="px-4 py-2 ">Nama Pasien</th>
                            <th class="px-4 py-2 ">Poli Tujuan</th>
                            <th class="px-4 py-2 ">Tanggal Kunjungan</th>
                            <th class="px-4 py-2 ">Jam Kunjungan</th>
                            <th class="px-4 py-2 ">Status</th>
                            <th class="px-4 py-2 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($kunjungan->isEmpty())
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                                    Data belum ada
                                </td>
                            </tr>
                        @else
                            @foreach ($kunjungan as $i => $p)
                                <tr class="border-b border-gray-200 even:hover:bg-gray-200 hover:bg-gray-100">
                                    <td class="px-4 py-2 ">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2 ">{{ $p->pasien->nama }}</td>
                                    <td class="px-4 py-2 ">{{ $p->poli->nama_poli }}</td>
                                    <td class="px-4 py-2 ">{{ $p->tanggal_kunjungan }}</td>
                                    <td class="px-4 py-2 ">{{ $p->jam_kunjungan }}</td>
                                    <td class="px-4 py-2">
                                        @if ($p->status_kunjungan == 'Selesai')
                                            <div
                                                class="inline-block px-3 py-1 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm">
                                                {{ $p->status_kunjungan }}
                                            </div>
                                        @else
                                            <div
                                                class="inline-block px-3 py-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-amber-500">
                                                {{ $p->status_kunjungan }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="flex items-center justify-center px-4 py-2 text-center">
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
                                                    Edit Data Kunjungan
                                                </div>
                                                <div
                                                    class="relative py-4 font-light leading-normal border-t border-slate-200 text-slate-600">
                                                    <form action="kunjungan/{{ $p->id }}/update" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-4">
                                                            <input type="text" name="pasien_id" class="hidden"
                                                                value="{{ $p->pasien->id }}" disabled />
                                                            <label
                                                                class="block mb-1 text-sm font-medium text-gray-700">Pasien</label>
                                                            <input type="text" name="pasien_id" placeholder="Nama Poli"
                                                                value="{{ old('nama', $p->pasien->nama) }}" disabled
                                                                class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border border-gray-300 rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow "
                                                                required />
                                                        </div>
                                                        <div class="mb-4">
                                                            <label
                                                                class="block mb-1 text-sm font-medium text-gray-700">Status</label>
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
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- <div class="my-4">
                {{ $kunjungan->links('pagination::tailwind') }}
            </div> --}}
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
