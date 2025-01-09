@extends('layouts.app')

@section('title', 'Details Rekam Medis')

@section('header', 'Details Rekam Medis Overview')

@section('content')
    <div class="w-full">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div class="w-full p-6 bg-white border-t-2 rounded-lg shadow-lg border-t-indigo-400">
            <div class="mb-4">
                <h3 class="text-2xl font-medium">Biodata Pasien</h3>
            </div>
            <div class="flex items-center mb-7">
                <div class="flex flex-col">
                    <div class="text-2xl text-gray-800">{{ $rm->pasien->nama }}</div>
                    <div class="font-medium text-gray-500">{{ $rm->pasien->nik }}</div>
                </div>
            </div>

            <div class="grid grid-cols-12 gap-y-4">

                <div class="col-span-3 font-medium text-gray-700">Nama</div>
                <div class="col-span-9 text-gray-800">: {{ $rm->pasien->nama }}</div>

                <div class="col-span-3 font-medium text-gray-700">Oleh Dokter</div>
                <div class="col-span-9 text-gray-800">: {{ $rm->dokter->poli->nama_poli }}</div>

                <div class="col-span-3 font-medium text-gray-700">Oleh Dokter</div>
                <div class="col-span-9 text-gray-800">: {{ $rm->dokter->nama_dokter }}</div>

                <div class="col-span-3 font-medium text-gray-700">Tanggal Pemerikasaan</div>
                <div class="col-span-9 text-gray-800">: {{ $rm->tanggal_pemeriksaan }}</div>

                <div class="col-span-3 font-medium text-gray-700">Keluhan</div>
                <div class="col-span-9 text-gray-800">: {{ $rm->keluhan }}</div>

                <div class="col-span-3 font-medium text-gray-700">Diagnosa</div>
                <div class="col-span-9 text-gray-800">: {{ $rm->diagnosa }}</div>

                <div class="col-span-3 font-medium text-gray-700">Obat</div>
                <div class="flex col-span-9 text-gray-800">:
                    <div class="mx-1">
                        @if ($rm->obatrm->isEmpty())
                            <p>-Tidak diberi obat</p>
                        @else
                            @foreach ($rm->obatrm as $i => $p)
                                <p class="flex flex-col">
                                    - {{ $p->nama_obat }}
                                </p>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-span-3 font-medium text-gray-700">Keterangan</div>
                <div class="col-span-9 text-gray-800">: {{ $rm->ket }}</div>
            </div>
        </div>
        <div class="flex w-full gap-10 py-10">
            <div class="w-1/2 p-6 bg-white border-t-2 rounded-lg shadow-lg border-t-indigo-400">
                <h3 class="py-4 text-2xl font-medium">Hasil Lab</h3>
                <div class="overflow-x-auto rounded-lg shadow-md">
                    <table id="users-table" class="w-full text-sm text-left bg-white rounded-t-lg">
                        <thead>
                            <tr class="text-gray-600 bg-slate-200">
                                <th class="px-4 py-2 ">No</th>
                                <th class="px-4 py-2 ">Hasil Labolatorium</th>
                                <th class="px-4 py-2 ">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($rm->lab->isEmpty())
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">Tidak Uji Lab</td>
                                </tr>
                            @else
                                @foreach ($rm->lab as $i => $p)
                                    <tr class="border-b border-gray-200 even:hover:bg-gray-200 hover:bg-gray-100">
                                        <td class="px-4 py-2 ">{{ $i + 1 }}</td>
                                        <td class="px-4 py-2 ">{!! nl2br(e($p->hasil_lab)) !!}</td>
                                        <td class="px-4 py-2 ">{{ $p->ket }}</td>
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
