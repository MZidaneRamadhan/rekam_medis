@extends('layouts.app')

@section('title', 'Pasien')

@section('header', 'Pasien Overview')

@section('content')
    <div>
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div>
            <h3 class="p-4 text-2xl font-medium">Data Pasien</h3>
        </div>
        <div class="p-4 bg-white border-t-2 rounded-md shadow-xl card border-t-indigo-400">
            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'resepsionis')
                <button data-dialog-target="dialog-xs"
                    class="px-4 py-2 mb-3 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                    type="button">
                    <i class="fas fa-plus"></i> Daftar Pasien Baru
                </button>
            @endif
            <div data-dialog-backdrop="dialog-xs" data-dialog-backdrop-close="true"
                class="pointer-events-none fixed inset-0 z-[999] grid h-screen w-screen place-items-center bg-black bg-opacity-60 opacity-0 backdrop-blur-sm transition-opacity duration-300">
                <div data-dialog="dialog-xs" class="relative w-1/4 p-4 m-4 bg-white rounded-lg shadow-sm">
                    <div class="flex items-center pb-4 text-xl font-medium shrink-0 text-slate-800">Daftar Pasien Baru</div>
                    <div class="relative py-4 font-light leading-normal border-t border-slate-200 text-slate-600">

                        <form action="/pasien-store" method="POST">
                            @csrf
                            <div class="">
                                <div class="mb-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700">NIK Pasien</label>
                                    <input type="text" name="nik" placeholder="NIK Pasien 3217..."
                                        value="{{ old('nik') }}"
                                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow @error('nik') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                                        required />
                                    @error('nik')
                                        <p class="mt-1 text-sm text-red-500">NIK Pasien Sudah Terdaftar</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700">Nama Lengkap</label>
                                    <input type="text" name="nama" placeholder="Nama Lengkap"
                                        value="{{ old('nama') }}"
                                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow @error('nama') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                                        required />
                                    @error('nama')
                                        <p class="mt-1 text-sm text-red-500">Nama Pasien sudah di tambahkan masukan Nama
                                            Pasien yang lain</p>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal
                                        Lahir</label>
                                    <input name="tanggal_lahir" placeholder="Tanggal Lahir"
                                        value="{{ old('tanggal_lahir') }}"
                                        class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                        required type="date" />
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700">Jenis
                                        Kelamin</label>
                                    <div class="inline-flex items-center">
                                        <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                            for="on" data-ripple-dark="true">
                                            <input name="jenis_kelamin" type="radio" value="Laki-laki" id="male"
                                                class="before:content[''] peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-300 checked:border-blue-400 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-400 before:opacity-0 before:transition-opacity hover:before:opacity-10"
                                                id="on" />
                                            <span
                                                class="absolute w-3 h-3 transition-opacity duration-200 transform -translate-x-1/2 -translate-y-1/2 bg-blue-600 rounded-full opacity-0 peer-checked:opacity-100 top-1/2 left-1/2"></span>
                                        </label>
                                        <label class="text-sm cursor-pointer text-slate-600" for="on">
                                            Laki-laki
                                        </label>
                                    </div>
                                    <div class="inline-flex items-center">
                                        <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                            for="of" data-ripple-dark="true">
                                            <input name="jenis_kelamin" type="radio" value="Perempuan" id="female"
                                                class="before:content[''] peer h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-300 checked:border-blue-400 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-400 before:opacity-0 before:transition-opacity hover:before:opacity-10"
                                                id="of" />
                                            <span
                                                class="absolute w-3 h-3 transition-opacity duration-200 transform -translate-x-1/2 -translate-y-1/2 bg-blue-600 rounded-full opacity-0 peer-checked:opacity-100 top-1/2 left-1/2"></span>
                                        </label>
                                        <label class="text-sm cursor-pointer text-slate-600" for="of">
                                            Perempuan
                                        </label>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700">Alamat</label>
                                    <input name="alamat" placeholder="Alamat" value="{{ old('alamat') }}"
                                        class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                        required />
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700">Nomor
                                        Telepon</label>
                                    <input name="telp" placeholder="Nomor Telepon (0894-*****)"
                                        value="{{ old('telp') }}" pattern="[0-9]*" inputmode="numeric" type="number"
                                        class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"
                                        required />
                                </div>
                                <div class="mb-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700">Agama</label>
                                    <select name="agama" id="agama"
                                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded pl-3 pr-8 py-1.5 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md appearance-none cursor-pointer">
                                        <option disabled selected> -- Pilih -- </option>
                                        <option value="Islam">Islam</option>
                                        <option value="Kristen">Kristen</option>
                                        <option value="Katolik">Katolik</option>
                                        <option value="Budha">Budha</option>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Konghuchu">Konghuchu</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center justify-end shrink-0">
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

            <div class="overflow-x-auto rounded-lg shadow-md">
                <table id="myTable" class="w-full text-sm text-left bg-white rounded-t-lg">
                    <thead>
                        <tr class="text-white bg-gray-400 rounded-t-lg">
                            <th class="px-4 py-2 font-extralight">No</th>
                            <th class="px-4 py-2 font-light ">NIK</th>
                            <th class="px-4 py-2 font-light ">Nama</th>
                            <th class="px-4 py-2 font-light ">No Telepon</th>
                            <th class="px-4 py-2 font-light ">Jenis Kelamin</th>
                            <th class="px-4 py-2 font-light ">Usia</th>
                            <th class="px-4 py-2 font-light text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pasien->isEmpty())
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-500">Data belum ada</td>
                            </tr>
                        @else
                            @foreach ($pasien as $i => $p)
                                <tr class="border-b border-gray-200 even:hover:bg-gray-200 hover:bg-gray-100">
                                    <td class="px-4 py-2 ">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2 ">{{ $p->nik }}</td>
                                    <td class="px-4 py-2 ">{{ $p->nama }}</td>
                                    <td class="px-4 py-2 ">{{ $p->telp }}</td>
                                    <td class="px-4 py-2 ">{{ $p->jenis_kelamin }}</td>
                                    <td class="px-4 py-2 ">{{ $p->usia_lengkap }} </td>
                                    <td class="flex items-center justify-center px-4 py-2 text-center">
                                        <a href="/pasien/{{ $p->id }}/details" data-dialog-target="modal-xs"
                                            class="relative px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md group hover:shadow-lg hover:shadow-blue-200 focus:bg-blue-600 focus:shadow-none active:bg-blue-800 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="items-center justify-center fas fa-file-lines"></i>
                                            <span
                                                class="absolute px-2 py-1 text-xs text-white transition-opacity transform -translate-x-1/2 -translate-y-8 bg-gray-800 rounded-md opacity-0 left-1/2 w-max group-hover:opacity-100">
                                                Lihat Detail Pasien
                                            </span>
                                        </a>
                                        @if (Auth::user()->role == 'admin')
                                            <a href="/pasien/{{ $p->id }}/edit" data-dialog-target="modal-xs"
                                                class="relative px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-yellow-600 border border-transparent rounded-md shadow-md group hover:shadow-lg hover:shadow-yellow-200 focus:bg-yellow-600 focus:shadow-none active:bg-yellow-800 hover:bg-yellow-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="items-center justify-center fas fa-pen"></i>
                                                <span
                                                    class="absolute px-2 py-1 text-xs text-white transition-opacity transform -translate-x-1/2 -translate-y-8 bg-gray-800 rounded-md opacity-0 left-1/2 w-max group-hover:opacity-100">
                                                    Edit Pasien
                                                </span>
                                            </a>
                                            <button onclick="modalDelete('{{ route('pasien.delete', $p->id) }}')"
                                                class="relative px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-red-600 border border-transparent rounded-md shadow-md group hover:shadow-lg hover:shadow-red-200 focus:bg-red-600 focus:shadow-none active:bg-red-800 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="items-center justify-center fas fa-trash"></i>
                                                <span
                                                    class="absolute px-2 py-1 text-xs text-white transition-opacity transform -translate-x-1/2 -translate-y-8 bg-gray-800 rounded-md opacity-0 left-1/2 w-max group-hover:opacity-100">
                                                    Hapus Data
                                                </span>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>

                    @include('components.modal-delete', ['deleteUrl' => ''])
                </table>
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
        function modalDelete(deleteUrl) {
            const modal = document.getElementById('modalDelete');
            modal.classList.remove('hidden');
            modal.querySelector('form').action = deleteUrl;
        }

        function closeDelete() {
            const modal = document.getElementById('modalDelete');
            modal.classList.add('hidden');
        }
        $(document).ready(function() {
            $('#myTable').DataTable({
                responsive: true,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ hingga _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    }
                }
            });
        });
    </script>
@endsection
