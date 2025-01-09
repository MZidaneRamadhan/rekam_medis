@extends('layouts.app')

@section('title', 'Invoice')

@section('header', 'Invoice')

@section('content')
    <div class="w-full">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <h3 class="my-5 text-2xl font-medium">Pemberian Obat Pasien</h3>
        <div class="flex w-full gap-10">
            <div class="w-3/5 p-6 bg-white border-t-2 rounded-lg shadow-lg border-t-indigo-400">
                <h1 class="mb-4 text-2xl font-bold text-center">Data Pasien</h1>
                <div class="grid grid-cols-12 gap-y-4">
                    <div class="col-span-3 font-medium text-gray-700">NIK</div>
                    <div class="col-span-9 font-bold text-gray-800">: {{ $rm->pasien->nik }}</div>

                    <div class="col-span-3 font-medium text-gray-700">Nama</div>
                    <div class="col-span-9 text-gray-800">: {{ $rm->pasien->nama }}</div>

                    <div class="col-span-3 font-medium text-gray-700">Usia</div>
                    <div class="col-span-9 text-gray-800">: {{ $rm->pasien->usia_lengkap }}</div>

                    <div class="col-span-3 font-medium text-gray-700">No. Telepon</div>
                    <div class="col-span-9 text-gray-800">: {{ $rm->pasien->telp }}</div>

                    <div class="col-span-3 font-medium text-gray-700">Poli Tujuan</div>
                    <div class="col-span-9 text-gray-800">: {{ $rm->dokter->poli->nama_poli }}</div>

                    <div class="col-span-3 font-medium text-gray-700">Tanggal Pemeriksaan</div>
                    <div class="col-span-9 text-gray-800">: {{ $rm->tanggal_pemeriksaan }}</div>
                </div>
            </div>
            <div class="w-2/5 p-6 bg-white border-t-2 rounded-lg shadow-lg border-t-indigo-400 ">
                <h1 class="mb-4 text-2xl font-bold text-center">Invoice</h1>

                <!-- Invoice Header -->
                <div class="flex justify-between mb-6">
                    <div>
                        <p class="text-sm text-gray-500">Invoice #: <span class="font-medium">{{ $invoice }}</span></p>
                        <p class="text-sm text-gray-500">Date: <span
                                class="font-medium"id="invoice-date">{{ $rm->tanggal_pemeriksaan }}</span></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Pasien: <span class="font-medium">{{ $rm->pasien->nama }}</span>
                        </p>
                        <p class="text-sm text-gray-500">Dokter: <span
                                class="font-medium">{{ $rm->dokter->nama_dokter }}</span>
                        </p>
                    </div>
                </div>

                <!-- Items Table -->
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr>
                            <th class="py-2 border-b">Item</th>
                            <th class="py-2 text-right border-b">Price</th>
                        </tr>
                    </thead>
                    <tbody id="item-list">
                        @php $totalHarga = 0; @endphp
                        @foreach ($rm->obatrm as $o)
                            <tr>
                                <!-- Nama Obat -->
                                <td class="px-4 py-2">
                                    {{ $o->nama_obat }}
                                </td>

                                <!-- Harga -->
                                <td class="flex items-end justify-end px-4 py-2 text-right">
                                    <P class="block ">Rp. </P>{{ number_format($o->harga, 0, ',', '.') }}
                                </td>
                            </tr>
                            @php $totalHarga += $o->harga; @endphp
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="py-2 font-bold border-t">Total</td>
                            <td class="py-2 font-bold text-right border-t" id="total-price">
                                Rp {{ number_format($totalHarga, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Button -->
                <div class="mt-6 text-center">
                    <form action="{{ route('rekamMedis.finish', ['id' => $rm->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit"
                            class="px-4 py-2 ml-2 text-center text-white transition-all bg-green-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-green-200 focus:bg-green-600 focus:shadow-none active:bg-green-800 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            <i class="mr-3 fas fa-receipt "></i>Selesaikan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script></script>
@endsection
