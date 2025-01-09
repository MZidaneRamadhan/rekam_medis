@extends('layouts.app')

@section('title', 'Pemeriksaan')

@section('header', 'Pemeriksaan')

@section('content')
    <div class="w-full">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div class="p-4 my-10 bg-white border-t-2 rounded-md shadow-xl border-t-indigo-400">
            <h3 class="px-4 text-2xl font-medium">Pemerikasaan Pasien</h3>
            <form action="{{ route('rekamMedis.store', $pasien->id) }}" method="POST">
                @csrf
                <input type="hidden" name="pasien_id" value="{{ $pasien->pasien->id }}">
                <div class="px-4 py-5 sm:p-6">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Nama Pasien</label>
                        <input type="text" name="nama" value="{{ $pasien->pasien->nama }}" disabled
                            class="w-full px-3 py-2 text-sm transition duration-300 border rounded-md shadow-sm pointer-events-none bg-slate-200 placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Poli Tujuan</label>
                        <input type="text" name="poli_id" value="{{ $pasien->poli->nama_poli }}" disabled
                            class="w-full px-3 py-2 text-sm transition duration-300 border rounded-md shadow-sm pointer-events-none bg-slate-200 placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Keluhan</label>
                        <textarea type="text" name="keluhan" placeholder="Keluhan"
                            class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Diagnosa</label>
                        <input type="text" name="diagnosa" placeholder="Diagnosa"
                            class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Tindakan</label>
                        <select name="tindakan_id"
                            class="w-full py-2 pl-3 pr-8 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm appearance-none cursor-pointer placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 focus:shadow-md">
                            <option selected disabled>-- Pilih Tindakan --</option>
                            @foreach ($tindakan as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_tindakan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Resep</label>
                        <textarea type="text" name="resep" placeholder="Resep Obat"
                            class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Obat</label>
                        <div id="obat-container">
                            <div class="flex gap-2 mb-2">
                                <select name="obat[]" id="selectObat" multiple
                                    class="w-full py-2 pl-3 pr-8 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm appearance-none cursor-pointer placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 focus:shadow-md">
                                    <option selected disabled>-- Pilih Obat --</option>
                                    @foreach ($obat as $p)
                                        <option value="{{ $p->id }}">{{ $p->nama_obat }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="button" onclick="addObat()" data-ripple-light="true"
                            class="px-4 py-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-blue-200 focus:bg-blue-600 focus:shadow-none active:bg-blue-800 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                            Tambah Obat
                        </button>
                        <div class="mb-4">
                            <label class="block mb-1 text-sm font-medium text-gray-700">Keterangan</label>
                            <textarea type="text" name="ket" placeholder="Keterangan"
                                class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"></textarea>
                        </div>
                    </div>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-center text-white transition-all bg-blue-600 border border-transparent rounded-md shadow-md hover:shadow-lg focus:bg-blue-700 focus:shadow-none active:bg-blue-700 hover:bg-blue-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        Tambah
                    </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let obatIndex = 1;

        function addObat() {
            const container = document.getElementById('obat-container');
            const div = document.createElement('div');
            div.classList.add('flex', 'gap-2', 'mb-2');
            div.innerHTML = `
            <select name="obat[]"
                class="w-full py-2 pl-3 pr-8 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm appearance-none cursor-pointer placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 focus:shadow-md">
                <option selected disabled>-- Pilih Obat --</option>
                @foreach ($obat as $p)
                    <option value="{{ $p->id }}">{{ $p->nama_obat }}</option>
                @endforeach
            </select>
            <button type="button" class="text-red-500" onclick="removeObat(this)">Hapus</button>
        `;
            container.appendChild(div);
            obatIndex++;
        }

        function removeObat(button) {
            const div = button.parentElement;
            div.remove();
        }

        $(document).ready(function() {
            $('#selectObat').select2({
                placeholder: "-- Pilih Obat --",
                allowClear: true
            });
        });
    </script>
@endsection

{{-- <input type="text" name="obat[${obatIndex}][jumlah]" placeholder="Jumlah"
    class="w-1/4 px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" />
--}}
