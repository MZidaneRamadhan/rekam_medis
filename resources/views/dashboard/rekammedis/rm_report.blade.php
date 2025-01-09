<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <title></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
        }

        .header img {
            width: 60px;
            height: auto;
            margin-bottom: 10px;
        }

        .header h1 {
            font-size: 16px;
            margin: 0;
        }

        .header p {
            margin: 0;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        th {
            font-size: 11px;
        }

        td {
            font-size: 10px;
        }

        .footer {
            text-align: right;
            margin-top: 20px;
            font-size: 11px;
        }
    </style>
    {{-- <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin-left: 20px;
            margin-right: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-left: 40px;
        }

        tr {
            margin-left: 20px;
        }

        th,
        td {
            /* padding: 10px; */
            margin-left: 20px;
            font-size: 14px;
        }

        .header {
            text-align: center;
            font-size: 11px;
        }

        .profile-image {
            text-align: start;
            margin-left: 40px;
            margin-top: 10px;
        }

        .profile-image img {
            width: 90px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style> --}}
</head>

<body>
    <div class="header">
        {{-- <img src="{{ public_path('Logo.png') }}" alt=""> --}}
        <div class="kop">
            <i class="fas fa-notes-medical"></i>
            <h1>Klinik Shatsaka Medical</h1>
            <p>No. Izin: xx.xxxx.xxx</p>
            <p>Jln. Mahar Martanegara Kota Cimahi</p>
            <p style="margin: 0; font-size: 12px; text-align: center; line-height: 1.2;">
                Website: <a href="http://www.shatsaka-med.id"
                    style="text-decoration: none; color: blue;">http://www.shatsaka-med.id</a>
                &nbsp; - &nbsp; e-mail: <a href="mailto:info@shatsaka-med..id"
                    style="text-decoration: none; color: blue;">info@shatsaka-med.id</a>
            </p>
        </div>
        <hr>
        <h1>LAPORAN REKAP DATA REKAM MEDIS PASIEN<br>PERIODE TAHUN 2025</h1>
        <hr>
        <table>
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="">Tanggal Pemeriksaan</th>
                    <th>No. RM</th>
                    <th>Nama Pasien</th>
                    <th>Jenis Kelamin</th>
                    <th>Nama Poli</th>
                    <th>Nama Dokter</th>
                    <th>Usia</th>
                    <th>Keluhan Utama</th>
                    <th>Diagnosa</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rm as $index => $rm)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $rm->tanggal_pemeriksaan }}</td>
                        <td>{{ $rm->no_rm }}</td>
                        <td>{{ $rm->pasien->nama }}</td>
                        <td>{{ $rm->pasien->jenis_kelamin }}</td>
                        <td>{{ $rm->dokter->poli->nama_poli }}</td>
                        <td>{{ $rm->dokter->nama_dokter }}</td>
                        <td>{{ $rm->pasien->usia }}</td>
                        <td>{{ $rm->keluhan }}</td>
                        <td>{{ $rm->diagnosa }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="footer">
            <p>Kota ..........., {{ now()->format('d F Y') }}</p>
            <p>Penanggung Jawab</p>
        </div>
    </div>
</body>

</html>
