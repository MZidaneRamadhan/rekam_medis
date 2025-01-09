<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekam Medis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid black;
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

        .page-break {
            page-break-after: always;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h3 {
            font-size: 14px;
            border-bottom: 1px solid #000;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            text-align: left;
            vertical-align: top;
            padding: 5px;
            border: 1px solid #000;
        }

        .info-table td {
            border: none;
            padding: 2px;
        }

        .info-table td.label {
            width: 20%;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 20px;
            border-top: 1px solid #000;
            padding-top: 5px;
        }
    </style>
</head>

<body>
    @foreach ($data as $patient)
        <div class="header">
            {{-- <img src="{{ public_path('Logo.png') }}" alt="Klinik Logo"> --}}
            <h1>Klinik Shatsaka Medical</h1>
            <p>No. Izin: xx.xxxx.xxx</p>
            <p>Jln. Mahar Martanegara Kota Cimahi</p>
        </div>

        <h3 style="text-align: center;">
            LAPORAN DETAIL DATA REKAM MEDIS PASIEN<br>
            {{-- PERIODE TANGGAL: {{ $start_date }} - {{ $end_date }} --}}
        </h3>

        <div class="section">
            <table class="info-table">
                <tr>
                    <td class="label">Tanggal Kunjungan</td>
                    <td>: {{ $patient->tanggal_pemeriksaan }}</td>
                    <td class="label">No Rekam Medis</td>
                    <td>: {{ $patient->no_rm }}</td>
                </tr>
                <tr>
                    <td class="label">Nama Pasien</td>
                    <td>: {{ $patient->pasien->nama }}</td>
                    <td class="label">Jenis Kelamin</td>
                    <td>: {{ $patient->pasien->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <td class="label">Tanggal Lahir</td>
                    <td>: {{ $patient->pasien->tanggal_lahir }}</td>
                    <td class="label">Alamat</td>
                    <td>: {{ $patient->pasien->alamat }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3>Pemeriksaan Utama</h3>
            <table>
                <tr>
                    <td class="label">Keluhan Utama</td>
                    <td>: {{ $patient->keluhan }}</td>
                </tr>
                <tr>
                    <td class="label">Diagnosa Utama</td>
                    <td>: {{ $patient->diagnosa }}</td>
                </tr>
                <tr>
                    <td class="label">Tindakan</td>
                    <td>: {{ $patient->tindakan->nama_tindakan }}</td>
                </tr>
                <tr>
                    <td class="label">Obat</td>
                    <td>
                        @if ($patient->obatrm->isNotEmpty())
                            @foreach ($patient->obatrm as $o)
                                - {{ $o->nama_obat }}<br>
                            @endforeach
                        @else
                            Tidak ada obat
                        @endif
                    </td>
                </tr>
            </table>
            <h3>Hasil Lab</h3>
            <table style="table-layout: fixed; width: 100%;">
                @if ($patient->lab != null)
                    @foreach ($patient->lab as $o)
                        <tr>
                            <td class="label" style="width: 20vw">Hasil Lab</td>
                            <td>{!! nl2br(e($o->hasil_lab)) !!}</td>
                        </tr>
                        <tr>
                            <td class="label" style="width: 75vw">Keterangan</td>
                            <td>: {{ $o->ket }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="label" style="width: 20vw">Hasil Lab</td>
                        <td>: -</td>
                    </tr>
                    <tr>
                        <td class="label" style="width: 75vw">Keterangan</td>
                        <td>: -</td>
                    </tr>
                @endif


            </table>
        </div>

        @if (!$loop->last)
            <div class="page-break"></div>
        @endif
    @endforeach

    <div class="footer">
        Klinik Shatsaka Medical - Laporan Rekam Medis Pasien
    </div>
</body>

</html>
