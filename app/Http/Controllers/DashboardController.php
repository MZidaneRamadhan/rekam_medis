<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Kunjungan;
use App\Models\Labolatorium;
use App\Models\Pasien;
use App\Models\Poliklinik;
use App\Models\RekamMedis;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $breadcrumbs = [
            ['label' => 'Home', 'url' => route('dashboard')],
        ];
        $new = Pasien::whereBetween('created_at', [Carbon::now()->subWeek(), Carbon::now()])->orderBy('id','DESC')->paginate(10);
        $pasien = Pasien::selectRaw("DATE(created_at) as day, COUNT(*) as count")
        ->whereYear('created_at', Carbon::now()->year) // Opsional: Filter tahun ini
        ->groupBy('day')
        ->orderBy('day')
        ->get();

        $jenisKelaminCounts = Pasien::selectRaw("jenis_kelamin, COUNT(*) as count")
        ->groupBy('jenis_kelamin')
        ->get();

        $labels = $jenisKelaminCounts->pluck('jenis_kelamin');
        $countsl = $jenisKelaminCounts->pluck('count');

        $countpasien = Pasien::count();
        $countdokter = Dokter::count();
        $countkunjungan = Kunjungan::count();
        $countrekam = RekamMedis::count();
        $countpoli = Poliklinik::count();
        $countlab = Labolatorium::count();


        $days = $pasien->pluck('day')->map(function ($date) {
            return Carbon::parse($date)->format('d M Y'); // Format tanggal
        });

        $counts = $pasien->pluck('count');
        // dd($labels, $counts);
        return view('dashboard.dashboard',compact('new','days','counts','countpasien','countdokter',
        'countrekam','countkunjungan','countpoli','countlab','labels','countsl','breadcrumbs'));
    }
    public function newPatients(){
        return view('dashboard.dashboard',compact('pasien'));
    }
}
