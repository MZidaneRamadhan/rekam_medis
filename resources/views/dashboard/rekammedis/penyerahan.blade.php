@extends('layouts.app')

@section('title', 'Penyerahan Obat')

@section('header', 'Penyerahan Obat Overview')

@section('content')
    <div class="w-full">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div>
            <h3 class="p-4 text-2xl font-medium">Data Penyerahan Obat</h3>
        </div>
        <div class="p-4 bg-white border-t-2 rounded-md shadow-xl border-t-indigo-400">
            <div class="overflow-x-auto rounded-md shadow-md ">
                <table id="users-table" class="w-full text-left bg-white rounded-t-lg">
                    <thead>
                        <tr class="text-white bg-gray-400">
                            <th class="px-4 py-2 font-light ">No</th>
                            <th class="px-4 py-2 font-light ">Nama Pasien</th>
                            <th class="px-4 py-2 font-light ">Usia</th>
                            <th class="px-4 py-2 font-light ">Poli</th>
                            <th class="px-4 py-2 font-light ">Daftar Obat</th>
                            <th class="px-4 py-2 font-light ">Status</th>
                            <th class="px-4 py-2 font-light text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rm->isEmpty())
                            <tr>
                                <td colspan="6" class="px-4 py-2 text-center text-gray-500">
                                    Data belum ada
                                </td>
                            </tr>
                        @else
                            @foreach ($rm as $i => $p)
                                <tr class="border-b border-gray-200 even:hover:bg-gray-200 hover:bg-gray-100">
                                    <td class="px-4 py-2 ">{{ $i + 1 }}</td>
                                    <td class="px-4 py-2 ">{{ $p->pasien->nama }}</td>
                                    <td class="px-4 py-2 ">{{ $p->pasien->usia_lengkap }}</td>
                                    <td class="px-4 py-2 ">{{ $p->dokter->poli->nama_poli }}</td>
                                    <td class="px-4 py-2 ">
                                        <div class="list-disc list-inside">
                                            @foreach ($p->obatrm as $o)
                                                <p>- {{ $o->nama_obat }}</p>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-4 py-2">
                                        @if ($p->status == 'Penyerahan Obat')
                                            <div
                                                class="inline-block px-3 py-1 text-sm font-medium text-white border border-transparent rounded-md shadow-sm bg-amber-500">
                                                {{ $p->status }}
                                            </div>
                                        @else
                                            <div
                                                class="inline-block px-3 py-1 text-sm font-medium text-white bg-green-500 border border-transparent rounded-md shadow-sm">
                                                {{ $p->status }}
                                            </div>
                                        @endif
                                    </td>
                                    <td class="items-center justify-center px-10 py-3 text-center">
                                        <a href="/rekam-medis/{{ $p->id }}/invoice" data-dialog-target="modal-xs"
                                            class="px-4 py-4 ml-2 text-sm text-center text-white transition-all bg-green-600 border border-transparent rounded-md shadow-md hover:shadow-lg hover:shadow-green-200 focus:bg-green-600 focus:shadow-none active:bg-green-800 hover:bg-green-700 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                            <i class="items-center justify-center text-lg fas fa-clipboard-check"></i>
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
