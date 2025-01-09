<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
// use Barryvdh\DomPDF\Facade as PDF;
use Barryvdh\DomPDF\Facade\Pdf;


class ReportController extends Controller
{
    public function reportrm()
    {
        // Ambil data yang ingin dilaporkan
        $rm = RekamMedis::all(); // Misalnya data rm

        // Menyusun view PDF
        $pdf = PDF::loadView('dashboard.rekammedis.rm_report', compact('rm'))
        ->setPaper('a4','landscape');

        // Download PDF
        return $pdf->stream('laporan_rekam-medis.pdf');
    }

    public function reportdetail()
    {
        $data = RekamMedis::where("diagnosa", "!=", null)
        // ->where("no_rm",'=',$id)
        ->with(["lab", "pasien", "dokter", "obatrm"])
        ->get();

        $pdf = PDF::loadView('dashboard.rekammedis.details_report', ['data' => $data])->setPaper('a4', 'portrait');

        return $pdf->stream('details_report.pdf');
    }
    public function generateExcel()
    {
        // Generate dan download file Excel
        return Excel::download(new RekamMedisExport, 'laporan_pasien.xlsx');
    }
}
