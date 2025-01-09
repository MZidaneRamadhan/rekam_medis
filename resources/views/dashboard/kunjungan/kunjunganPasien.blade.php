@extends('layouts.app')

@section('title', 'Kunjungan')

@section('header', 'Mulai ')

@section('content')
<div class="w-full">
    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    <div class="p-4 bg-white rounded-md shadow-xl">
        <h3 class="px-4 text-2xl font-medium">Mulai Kunjungan Pasien</h3>
        <form action="/kunjungan-store" method="POST">
            @csrf
            <input type="hidden" name="pasien_id" value="{{ $pasien->id }}">
            <div class="px-4 py-5 sm:p-6">
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Nama Pasien</label>
                    <input type="text" name="nama" placeholder="Nama Dokter" value="{{ $pasien->nama }}" disabled
                        class="w-full px-3 py-2 text-sm transition duration-300 border rounded-md shadow-sm pointer-events-none bg-slate-200 placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" />
                </div>
                <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Poli</label>
                    <div class="w-full max-w-sm min-w-[200px] ">
                        <div class="relative">
                            <select name="poli_id"
                                class="w-full py-2 pl-3 pr-8 text-sm transition duration-300 bg-transparent border rounded shadow-sm appearance-none cursor-pointer placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 focus:shadow-md">
                                <option selected disabled>-- Pilih Poli --</option>
                                @foreach ($poli as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_poli }}</option>
                                @endforeach
                            </select>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.2"
                                stroke="currentColor" class="h-5 w-5 ml-1 absolute top-2.5 right-2.5 text-slate-700">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 15 12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                            </svg>
                        </div>
                    </div>
                </div>
                {{-- <div class="mb-4">
                    <label class="block mb-1 text-sm font-medium text-gray-700">Nama Dokter</label>
                    <input type="text" name="nama_dokter" placeholder="Nama Dokter" value="{{ old('nama_dokter') }}"
                        class="w-full bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-300 rounded-md px-3 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow @error('nama_dokter') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                        required />
                    @error('nama_dokter')
                    <p class="mt-1 text-sm text-red-500">Obat sudah di tambahkan masukan data obat
                        yang lain</p>
                    @enderror
                </div> --}}
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