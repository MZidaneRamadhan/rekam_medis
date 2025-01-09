@extends('layouts.app')

@section('title', 'Permintaan Labolatorium')

@section('header', 'Antrian Permintaan Labolatorium')

@section('content')
    <div class="w-full">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div class="p-4 bg-white rounded-md shadow-xl ">
            <h3 class="pb-4 text-2xl font-medium">Pemerikasaan Lab</h3>
            <div class="overflow-x-auto rounded-lg shadow-md">
                <table id="users-table" class="w-full text-left bg-white">
                    <thead>
                        <tr class="text-white bg-gray-400 ">
                            <th class="px-4 py-2 font-light ">#</th>
                            <th class="px-4 py-2 font-light ">Nama</th>
                            <th class="px-4 py-2 font-light ">Jenis Kelamin</th>
                            <th class="px-4 py-2 font-light ">Usia</th>
                            <th class="px-4 py-2 font-light ">Poli Tujuan</th>
                            <th class="px-4 py-2 font-light text-center ">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pasien->isEmpty())
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-xl text-center text-gray-600">
                                    Data belum ada
                                </td>
                            </tr>
                        @else
                            @foreach ($pasien as $i => $p)
                                <tr class="border-b border-gray-200 even:hover:bg-gray-200 hover:bg-gray-100">
                                    <td class="px-4 py-2 ">{{ $i + 1 }} </td>
                                    <td class="px-4 py-2 ">
                                        <a href="/pasien/{{ $p->pasien->id }}/details">{{ $p->pasien->nama }}</a>
                                    </td>
                                    <td class="px-4 py-2 ">{{ $p->pasien->jenis_kelamin }}</td>
                                    <td class="px-4 py-2 ">{{ $p->pasien->usia_lengkap }}</td>
                                    <td class="px-4 py-2 ">{{ $p->dokter->poli->nama_poli }}</td>
                                    <td class="flex items-center justify-center px-2 py-2 text-center">
                                        <a href="/lab/{{ $p->id }}/penanganan"
                                            class="px-4 py-2 ml-2 text-sm text-center text-white transition-all bg-green-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-green-200 focus:bg-green-600 focus:shadow-none active:bg-green-800 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="items-center justify-center fas fa-microscope"></i> Periksa
                                        </a>
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
    <script></script>
@endsection
