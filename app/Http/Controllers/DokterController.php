<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Poliklinik;
use App\Models\RekamMedis;
use App\Models\Tindakan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DokterController extends Controller
{
    public function index(){
        $dokter = Dokter::with('poli')->get();
        $poli = Poliklinik::all();
        $breadcrumbs = [
            ['label' => 'Dokter', 'url' => route('dashboard.dokter.index')],
        ];
        return view('dashboard.dokter.index', compact('dokter','poli','breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'     => 'required',
            'password'     => 'required',
            'password'     => 'required',
            'poli_id'     => 'required',
            'SIP'     => 'required',
            'telp'     => 'required',
            'alamat'     => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $user = User::create([
            'name'  => $request->name,
            'email'  => $request->email,
            'password'  => $request->password,
            'role'  => 'dokter',
        ]);
        $dokter = Dokter::create([
            'poli_id'  => $request->poli_id,
            'user_id'  => $user->id,
            'nama_dokter'  => $user->name,
            'SIP'  => $request->SIP,
            'telp'  => $request->telp,
            'alamat'  => $request->alamat,
        ]);

        return redirect('/dokter')->with('success', 'Berhasil menambahkan dokter!');
    }
    public function antrianPasien()
    {
        $dokter = Auth::user()->dokter;
        $pasien = Kunjungan::where('poli_id', $dokter->poli_id)
        ->where('status_kunjungan', 'Menunggu')
        ->get();

        $antrianCount = $pasien->count();

        $breadcrumbs = [
            ['label' => 'Daftar Pemerikasaan', 'url' => route('antrianPasien')],
        ];
        return view('dashboard.dokter.antrianPasien', compact('pasien', 'antrianCount', 'breadcrumbs'));
    }

    public function waitedLab()
    {
        $dokter = Auth::user()->dokter;
        $pasien = RekamMedis::where('dokter_id', $dokter->id)
        ->where('status', 'Menunggu Hasil Lab')
        ->orWhere('status', 'Hasil Lab Selesai')
        ->get();
        $breadcrumbs = [
            ['label' => 'Daftar Pemerikasaan', 'url' => route('waitedLab')],
        ];
        return view('dashboard.dokter.waitedLab', compact('pasien','breadcrumbs'));
    }
    public function medicalCheckup($id)
    {
        $pasien = Kunjungan::with(['pasien','poli'])->findOrFail($id);
        $obat = Obat::get();
        $tindakan = Tindakan::get();
        $breadcrumbs = [
            ['label' => 'Pasien Berobat', 'url' => route('antrianPasien')],
            ['label' => 'Pemerikasaan', 'url' => route('pemeriksaan', ['id' => $id])],
        ];
        return view('dashboard.dokter.pemeriksaan', compact('pasien','obat','tindakan','breadcrumbs'));
    }

    public function update(Request $request, $id)
    {

        $dokter = Dokter::findOrFail($id);

        $dokter->poli_id = $request->poli_id;
        $dokter->nama_dokter = $request->nama_dokter;
        $dokter->SIP = $request->SIP;
        $dokter->telp = $request->telp;
        $dokter->alamat = $request->alamat;

        $dokter->save();

        return to_route('dashboard.dokter.index')->with('success', 'Data berhasil diperbarui.');
    }
    public function show($id)
    {
        $dokter = Dokter::with('poli')->findOrFail($id);
        $breadcrumbs = [
            ['label' => 'Dokter', 'url' => route('dashboard.dokter.index')],
            ['label' =>  $dokter->nama, 'url' => route('details.dokter', $id)],
        ];
        return view('dashboard.dokter.detailsdokter', compact('dokter','breadcrumbs'));

    }
    public function destroy($id)
    {
        $user = Dokter::findOrFail($id);
        $user->delete();


        return to_route('dashboard.dokter.index')->with('success', 'Data berhasil dihapus.');
        // return redirect()->route('dashboard.dokter.index')->with('success', 'Data berhasil dihapus.');
    }
}
