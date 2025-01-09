<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\RekamMedis;
use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RekamMedisController extends Controller
{
    public function index(){
        $breadcrumbs = [
            ['label' => 'Rekam Medis', 'url' => route('dashboard.rekammedis.index')],
        ];
        $rekam = RekamMedis::with('pasien','dokter')->paginate(10);
        return view('dashboard.rekammedis.index', compact('rekam','breadcrumbs'));
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'tindakan_id' => 'nullable',
            'keluhan' => 'required|string',
            'diagnosa' => 'nullable|string',
            'resep' => 'nullable|string',
            'obat' => 'nullable|array',
            'obat.*' => 'exists:obat,id',
            'ket' => 'nullable|string',
        ]);

        $data = $validated;
        $tindakan_id = $data['tindakan_id'] ?? null;

        $rekam = RekamMedis::create([
            'pasien_id' => $data['pasien_id'],
            'tindakan_id' => $tindakan_id,
            'dokter_id' => Auth::user()->dokter->id,
            'diagnosa' => $data['diagnosa'],
            'keluhan' => $data['keluhan'],
            'tanggal_pemeriksaan' => now(),
            'resep' => $data['resep'],
            'ket' => $data['ket'],
            'status' => $data['diagnosa'] ? 'Penyerahan Obat' : 'Menunggu Hasil Lab',
        ]);

        $rekam->update([
            'no_rm' => 'RM' . date('Y') . str_pad($rekam->id, 6, '0', STR_PAD_LEFT),
        ]);
        // $obat = $data['obat'] ?? [];

        if (!empty($validated['obat'])) {
            $rekam->obatrm()->attach($validated['obat']);
        }
        // foreach ($obat as $obatData) {
        //     $obat = Obat::find($obatData);

        //     if ($obat) {
        //         $rekam->obatrm()->create([
        //             'obat_id' => $obat->id,
        //         ]);
        //     }
        // }

        $kunjungan = Kunjungan::findOrFail($id);
        $kunjungan->status_kunjungan = 'Selesai';
        $kunjungan->save();

        return redirect()->route('dashboard.rekammedis.index')->with('success', 'Data pemeriksaan selesai!');
    }

    public function edit($id)
    {
        $rm = RekamMedis::with('obatrm', 'pasien', 'dokter')->findOrFail($id);
        $obat = Obat::get();
        $tindakan = Tindakan::get();
        $breadcrumbs = [
            ['label' => 'Pemeriksaan', 'url' => route('waitedLab')],
            ['label' => 'Edit', 'url' => route('rekamMedis.edit', ['id' => $id])],
        ];
        return view('dashboard.rekammedis.edit', compact('rm','tindakan','obat', 'breadcrumbs'));
    }
    public function update(Request $request, $id)
    {
    // dd($request->all());
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasien,id',
            'tindakan_id' => 'required',
            'keluhan' => 'required|string',
            'diagnosa' => 'nullable|string',
            'resep' => 'nullable|string',
            'obat' => 'nullable|array',
            'obat.*' => 'exists:obat,id',
            'ket' => 'nullable|string',
        ]);
        $data = $validated;

        $rekam = RekamMedis::findOrFail($id);

        $rekam->update([
            'pasien_id' => $data['pasien_id'],
            'tindakan_id' => $data['tindakan_id'],
            'dokter_id' => Auth::user()->dokter->id,
            'diagnosa' => $data['diagnosa'],
            'keluhan' => $data['keluhan'],
            'tanggal_pemeriksaan' => now(),
            'resep' => $data['resep'],
            'ket' => $data['ket'],
            'status' => 'Penyerahan Obat',
        ]);
        $obat = $data['obat'] ?? [];

        $rekam->obatrm()->attach($validated['obat']);
        // $rekam->obatrm()->sync(array_map(function ($obatId) {
        //     return ['obat_id' => $obatId];
        // }, $obat));
        return redirect()->route('dashboard.rekammedis.index')->with('success', 'Data pemeriksaan berhasil diperbarui!');
    }
    public function penyerahanObat()
    {
        $rm = RekamMedis::with('obatrm')->where('status', 'Penyerahan obat')->get();

        $breadcrumbs = [
            ['label' => 'Daftar Penyerahan Obat', 'url' => route('penyerahan')],
        ];
        return view('dashboard.rekammedis.penyerahan', compact('rm','breadcrumbs'));
    }

    public function invoice($id)
    {
        $rm = RekamMedis::with('obatrm', 'pasien', 'dokter')->findOrFail($id);
        $invoice = 'INV-' . str_pad($id, 5, '0', STR_PAD_LEFT);
        $breadcrumbs = [
            ['label' => 'Invoice', 'url' => route('invoice', ['id' => $id])],
        ];
        return view('dashboard.rekammedis.invoice', compact('rm','invoice', 'breadcrumbs'));
    }

    public function show($id)
    {
        $rm = RekamMedis::with('obatrm','pasien','dokter')->findOrFail($id);
        $breadcrumbs = [
            ['label' => 'Pasien', 'url' => route('dashboard.pasien.index')],
            ['label' =>  $rm->pasien->nama, 'url' => route('details', $id)],
        ];
        return view('dashboard.rekammedis.details', compact('rm','breadcrumbs'));
    }

    public function finish($id)
    {
        $rm = RekamMedis::findOrFail($id);
        $rm->status = 'Selesai';
        $rm->save();

        return redirect()->route('penyerahan')->with('success', 'Data pemeriksaan Selesai!');
    }

    public function destroy($id)
    {
        $rekam = RekamMedis::findOrFail($id);
        $rekam->delete();

        return redirect()->route('dashboard.rekammedis.index')->with('success', 'Data Rekam Medis berhasil dihapus!');
    }
}
