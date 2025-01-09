@extends('layouts.app')

@section('title', 'Pemeriksaan')

@section('header', 'Pemeriksaan')

@section('content')
    <div class="w-full">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div class="p-4 bg-white rounded-md shadow-xl">
            <h3 class="px-4 text-2xl font-medium">Pemerikasaan Pasien</h3>
            <form action="{{ route('lab.store', $rm->id) }}" method="POST">
                @csrf
                <input type="hidden" name="rekam_medis_id" value="{{ $rm->id }}">
                <div class="px-4 py-5 sm:p-6">
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Keluhan</label>
                        <input type="text" value="{{ $rm->keluhan }}" disabled
                            class="w-full px-3 py-2 text-sm transition duration-300 border rounded-md shadow-sm pointer-events-none bg-slate-200 placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 text-sm font-medium text-gray-700">Hasil Lab</label>
                        <textarea type="text" name="hasil_lab" placeholder="Hasil Lab"
                            class="w-full px-3 py-2 text-sm transition duration-300 bg-transparent border rounded-md shadow-sm placeholder:text-slate-400 text-slate-700 border-slate-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 focus:shadow"></textarea>
                    </div>
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
    <script></script>
@endsection
