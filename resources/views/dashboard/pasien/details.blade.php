@extends('layouts.app')

@section('title', 'Pasien')

@section('header', 'Pasien Overview')

@section('content')
    <div class="w-full">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div class="w-full p-6 bg-white border-t-2 rounded-lg shadow-lg border-t-indigo-400">
            <div class="mb-4">
                <h3 class="text-2xl font-medium">Biodata Pasien</h3>
            </div>
            <div class="flex items-center justify-between mb-7">
                <div class="flex flex-col">
                    <div class="text-2xl text-gray-800">{{ $pasien->nama }}</div>
                    <div class="font-medium text-gray-500">{{ $pasien->nik }}</div>
                </div>
                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'resepsionis')
                    <a href="/pasien/{{ $pasien->id }}/kunjungan"
                        class="flex items-center justify-center px-4 py-3 ml-10 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md group hover:shadow-lg hover:shadow-blue-200 focus:bg-blue-600 focus:shadow-none active:bg-blue-800 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        <i class="mr-3 fas fa-notes-medical"></i>
                        Mulai berobat
                    </a>
                @endif
            </div>
            <div class="grid grid-cols-12 gap-y-4">
                <div class="col-span-3 font-medium text-gray-700">NIK</div>
                <div class="col-span-9 font-bold text-gray-800">: {{ $pasien->nik }}</div>

                <div class="col-span-3 font-medium text-gray-700">Nama</div>
                <div class="col-span-9 text-gray-800">: {{ $pasien->nama }}</div>

                <div class="col-span-3 font-medium text-gray-700">Usia</div>
                <div class="col-span-9 text-gray-800">: {{ $pasien->usia_lengkap }}</div>

                <div class="col-span-3 font-medium text-gray-700">Tanggal Lahir</div>
                <div class="col-span-9 text-gray-800">: {{ $pasien->tanggal_lahir }}</div>

                <div class="col-span-3 font-medium text-gray-700">Alamat</div>
                <div class="col-span-9 text-gray-800">: {{ $pasien->alamat }}</div>

                <div class="col-span-3 font-medium text-gray-700">No. Telepon</div>
                <div class="col-span-9 text-gray-800">: {{ $pasien->telp }}</div>

                <div class="col-span-3 font-medium text-gray-700">Agama</div>
                <div class="col-span-9 text-gray-800">: {{ $pasien->agama }}</div>
            </div>
        </div>
        <div>
            <h3 class="p-4 my-4 text-2xl font-medium">Riwayat Berobat</h3>
        </div>
        <div class="flex w-full gap-10 mb-10 ">
            <div class="w-1/2 p-6 bg-white border-t-2 rounded-lg shadow-lg border-t-indigo-400">
                <div class="overflow-x-auto rounded-lg shadow-md">
                    <table id="users-table" class="w-full text-sm text-left bg-white rounded-t-lg">
                        <thead>
                            <tr class="text-gray-600 bg-slate-200">
                                <th class="px-4 py-2 ">No</th>
                                <th class="px-4 py-2 ">Tanggal Pemerikasaan</th>
                                <th class="px-4 py-2 ">Poli Tujuan</th>
                                <th class="px-4 py-2 ">Dokter</th>
                                <th class="px-4 py-2 ">Tindakan</th>
                                <th class="px-4 py-2 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pasien->rekamMedis->isEmpty())
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">Data belum ada</td>
                                </tr>
                            @else
                                @foreach ($pasien->rekamMedis as $i => $p)
                                    <tr class="border-b border-gray-200 even:hover:bg-gray-200 hover:bg-gray-100">
                                        <td class="px-4 py-2 ">{{ $i + 1 }}</td>
                                        <td class="px-4 py-2 ">{{ $p->tanggal_pemeriksaan }}</td>
                                        <td class="px-4 py-2 ">{{ $p->dokter->poli->nama_poli }}</td>
                                        <td class="px-4 py-2 ">{{ $p->dokter->nama_dokter }} </td>
                                        <td class="px-4 py-2 ">{{ $p->tindakan->nama_tindakan }}</td>
                                        <td class="flex items-center justify-center px-4 py-2 text-center">
                                            <a href="/rekam-medis/{{ $p->id }}/details" data-ripple-light="true"
                                                data-tooltip-target="detail"
                                                class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-green-600 border border-transparent rounded-md shadow-md group hover:shadow-lg hover:shadow-green-200 focus:bg-green-600 focus:shadow-none active:bg-green-800 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="items-center justify-center fas fa-book-medical"></i>
                                                <div data-tooltip="detail"
                                                    class="absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                                                    Detail Rekam Medis
                                                </div>
                                            </a>
                                            @if (Auth::user()->role == 'admin')
                                                <a href="/rekam-medis/{{ $p->id }}/edit"data-ripple-light="true"
                                                    data-tooltip-target="tooltip"
                                                    class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-yellow-600 border border-transparent rounded-md shadow-md group hover:shadow-lg hover:shadow-yellow-200 focus:bg-yellow-600 focus:shadow-none active:bg-yellow-800 hover:bg-yellow-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                    <i class="items-center justify-center fas fa-pen"></i>
                                                    <div data-tooltip="tooltip"
                                                        class="absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                                                        Edit Rekam Medis
                                                    </div>
                                                </a>
                                            @endif
                                            {{-- <button onclick="modalDelete('{{ route('rekammedis.delete', $p->id) }}')"
                                                data-ripple-light="true" data-tooltip-target="delete"
                                                class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-red-600 border border-transparent rounded-md shadow-md group hover:shadow-lg hover:shadow-red-200 focus:bg-red-600 focus:shadow-none active:bg-red-800 hover:bg-red-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="items-center justify-center fas fa-trash"></i>
                                                <div data-tooltip="delete"
                                                    class="absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">
                                                    Hapus data
                                                </div>
                                            </button>
                                            @include('components.modal-delete', ['deleteUrl' => '']) --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="w-1/2 p-6 bg-white border-t-2 rounded-lg shadow-lg border-t-indigo-400">
                <div class="overflow-x-auto rounded-lg shadow-md">
                    <table id="users-table" class="w-full text-sm text-left bg-white rounded-t-lg">
                        <thead>
                            <tr class="text-gray-600 bg-slate-200">
                                <th class="px-4 py-2 ">No</th>
                                <th class="px-4 py-2 ">Tanggal Kunjungan</th>
                                <th class="px-4 py-2 ">Jam Kunjungan</th>
                                <th class="px-4 py-2 ">Tujuan Poli</th>
                                <th class="px-4 py-2 ">Status Kunjungan</th>
                                {{-- <th class="px-4 py-2 text-center">Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @if ($pasien->kunjungan->isEmpty())
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">Data belum ada</td>
                                </tr>
                            @else
                                @foreach ($pasien->kunjungan as $i => $p)
                                    <tr class="border-b border-gray-200 even:hover:bg-gray-200 hover:bg-gray-100">
                                        <td class="px-4 py-2 ">{{ $i + 1 }}</td>
                                        <td class="px-4 py-2 ">{{ $p->tanggal_kunjungan }}</td>
                                        <td class="px-4 py-2 ">{{ $p->jam_kunjungan }}</td>
                                        <td class="px-4 py-2 ">{{ $p->poli->nama_poli }}</td>
                                        <td class="px-4 py-2 ">
                                            @if ($p->status_kunjungan == 'Menunggu')
                                                <div
                                                    class="inline-block px-3 py-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-amber-500">
                                                    {{ $p->status_kunjungan }}
                                                </div>
                                            @else
                                                <div
                                                    class="inline-block px-3 py-1 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm">
                                                    {{ $p->status_kunjungan }}
                                                </div>
                                            @endif
                                        </td>
                                        {{-- <td class="flex items-center justify-center px-4 py-2 text-center">
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
                                                <div data-tooltip="tooltip"
                                                    class="absolute z-50 whitespace-normal break-words rounded-lg bg-black py-1.5 px-3 font-sans text-sm font-normal text-white focus:outline-none">

                                                </div>
                                            </button>
                                            @include('components.modal-delete', ['deleteUrl' => ''])
                                        </td> --}}
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
