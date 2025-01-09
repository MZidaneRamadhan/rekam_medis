@extends('layouts.app')

@section('title', 'Details Data Dokter ')


@section('content')
    <div class="w-full">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div class="w-full p-6 bg-white border-t-2 rounded-lg shadow-lg border-t-indigo-400">
            <div class="mb-4">
                <h3 class="text-2xl font-medium">Biodata Dokter</h3>
            </div>
            <div class="flex items-center mb-7">
                <div class="flex flex-col">
                    <div class="text-2xl text-gray-800">{{ $dokter->nama_dokter }}</div>
                    {{-- <div class="font-medium text-gray-500">{{ $dokter }}</div> --}}
                </div>
            </div>

            <div class="grid grid-cols-12 gap-y-4">

                <div class="col-span-3 font-medium text-gray-700">Nama</div>
                <div class="col-span-9 text-gray-800">: {{ $dokter->nama_dokter }}</div>

                <div class="col-span-3 font-medium text-gray-700">Poli</div>
                <div class="col-span-9 text-gray-800">: {{ $dokter->poli->nama_poli }}</div>

                <div class="col-span-3 font-medium text-gray-700">No SIP</div>
                <div class="col-span-9 text-gray-800">: {{ $dokter->SIP }}</div>

                <div class="col-span-3 font-medium text-gray-700">No Telepon</div>
                <div class="col-span-9 text-gray-800">: {{ $dokter->telp }}</div>

                <div class="col-span-3 font-medium text-gray-700">Alamat</div>
                <div class="col-span-9 text-gray-800">: {{ $dokter->alamat }}</div>
                {{--
                <div class="col-span-3 font-medium text-gray-700">Diagnosa</div>
                <div class="col-span-9 text-gray-800">: {{ $dokter->diagnosa }}</div>

                <div class="col-span-3 font-medium text-gray-700">Keterangan</div>
                <div class="col-span-9 text-gray-800">: {{ $rm->ket }}</div> --}}
            </div>
        </div>
    </div>
@endsection
