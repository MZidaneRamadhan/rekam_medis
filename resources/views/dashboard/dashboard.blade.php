@extends('layouts.app')

@section('title', 'Dashboard')


@section('content')
    <div class="w-full">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
        <div class="flex flex-wrap justify-center py-5 gap-x-7 gap-y-12 ">
            <x-datacard title="Pasien" icon="fas fa-user mt-2 h-8 w-9 text-xl"
                color="bg-gradient-to-tr from-green-700 to-green-500" more="/pasien">
                {{ $countpasien }}
            </x-datacard>
            <x-datacard title="Dokter" icon="fas fa-user-doctor mt-2 h-8 w-9 text-xl"
                color="bg-gradient-to-tr from-blue-700 to-blue-500" more="/dokter">
                {{ $countdokter }}
            </x-datacard>
            <x-datacard title="Kunjungan" icon="fas fa-hospital-user mt-2 h-8 w-9 text-xl"
                color="bg-gradient-to-tr from-indigo-700 to-indigo-500" more="/kunjungan">
                {{ $countkunjungan }}
            </x-datacard>
            <x-datacard title="Rekam Medis" icon="fas fa-notes-medical mt-2 h-8 w-9 text-xl"
                color="bg-gradient-to-tr from-amber-700 to-amber-500" more="/rekam-medis">
                {{ $countrekam }}
            </x-datacard>
            <x-datacard title="Uji Labolatorium" icon="fas fa-microscope mt-2 h-8 w-9 text-xl"
                color="bg-gradient-to-tr from-red-700 to-red-500" more="/rekam-medis">
                {{ $countlab }}
            </x-datacard>
            @if (Auth::user()->role == 'admin')
                <x-datacard title="Poli" icon="fas fa-hospital mt-2 h-8 w-9 text-xl"
                    color="bg-gradient-to-tr from-blue-700 to-blue-500" more="/poli">
                    {{ $countpoli }}
                </x-datacard>
            @endif
        </div>
        <div class="flex gap-5">
            <div class="container w-1/2 mt-10">
                <h2 class="mb-4 text-2xl font-semibold ">Data Pasien Per Hari</h2>
                <div class="w-full">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="container w-1/2 mt-10">
                <h2 class="mb-4 text-2xl font-semibold">Pasien Baru Terdaftar</h2>
                <div class="overflow-x-auto rounded-lg shadow-md">
                    <table class="w-full text-xs text-left text-gray-500 bg-white bg-">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th scope="col" class="px-2 py-3 text-center">#</th>
                                <th scope="col" class="py-3">Nama</th>
                                <th scope="col" class="py-3">Usia</th>
                                <th scope="col" class="py-3">Tanggal Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($new as $key => $user)
                                <tr class="bg-white border-b hover:bg-gray-100">
                                    <td class="px-2 py-3 text-center">{{ $key + 1 }}</td>
                                    <td class="py-3 ">{{ $user->nama }}</td>
                                    <td class="py-3 ">{{ $user->usia_lengkap }}</td>
                                    <td class="py-3 ">{{ $user->created_at->format('d M Y H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-4 text-center text-gray-500">Tidak ada data user baru
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>


        @if (session('success'))
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            </script>
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($days),
                datasets: [{
                    label: 'Jumlah Pasien ',
                    data: @json($counts),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        const ctx = document.getElementById('genderChart').getContext('2d');
        const genderChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: @json($labels), // Menampilkan label jenis kelamin
                datasets: [{
                    label: 'Jumlah Pasien berdasarkan Jenis Kelamin',
                    data: @json($countsl), // Menampilkan jumlah pasien berdasarkan jenis kelamin
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)', // Warna untuk Laki-laki
                        'rgba(255, 99, 132, 0.2)' // Warna untuk Perempuan
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' pasien';
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
