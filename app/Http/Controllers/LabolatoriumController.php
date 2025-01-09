<?php

namespace App\Http\Controllers;

use App\Models\Labolatorium;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LabolatoriumController extends Controller
{
    public function index(){
        $lab = Labolatorium::all();
        $breadcrumbs = [
            ['label' => 'Data Lab', 'url' => route('lab')],
        ];
        return view('dashboard.lab.index', compact('lab','breadcrumbs'));
    }

    public function permintaanLab(){
        $pasien = RekamMedis::where('status', 'Menunggu Hasil Lab')->get();
        $breadcrumbs = [
            ['label' => 'Daftar Pemerikasaan Lab', 'url' => route('lab.permintaan')],
        ];
        return view('dashboard.lab.permintaanLab', compact('pasien','breadcrumbs'));
    }

    public function lab($id){
        $rm = RekamMedis::with(['pasien'])->findOrFail($id);
        $breadcrumbs = [
            ['label' => 'Lab', 'url' => route('lab.permintaan')],
            ['label' => 'Pemerikasaan', 'url' => route('lab.penanganan', ['id' => $id])],
        ];
        return view('dashboard.lab.labolatorium', compact('rm','breadcrumbs'));
    }

    public function store(Request $request,$id)
    {
        $validated = Validator::make($request->all(), [
            'rekam_medis_id' => 'required|exists:rekam_medis,id',
            'hasil_lab' => 'required',
            'ket' => 'nullable|string',
        ]);
        $rekam = Labolatorium::create([
            'no_lab' => null,
            'rekam_medis_id' => $request->rekam_medis_id,
            'hasil_lab' => $request->hasil_lab,
            'ket' => $request->ket,
        ]);

        $rekamMedis = RekamMedis::find($request->rekam_medis_id);

        // Update nomor laboratorium
        $rekam->update([
            'no_lab' => 'LAB' . date('Y') . $rekamMedis->pasien_id . str_pad($rekam->id, 6, '0', STR_PAD_LEFT),
        ]);

        $kunjungan = RekamMedis::findOrFail($id);
        $kunjungan->status = 'Hasil Lab Selesai';
        $kunjungan->save();

        return redirect()->route("lab.permintaan")->with('success', 'Pemeriksaan Lab selesai!');
    }

    public function destroy($id)
    {
        $user = Labolatorium::findOrFail($id);
        $user->delete();

    }
}
