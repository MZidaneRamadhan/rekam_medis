<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Carbon\Carbon;
use App\Models\Kunjungan;
use App\Models\Pasien;
use App\Models\Poliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KunjunganController extends Controller
{
    public function index(){
        $breadcrumbs = [
            ['label' => 'Kunjungan', 'url' => route('dashboard.kunjungan.index')],
        ];
        $kunjungan = Kunjungan::all();
        return view('dashboard.kunjungan.index', compact('kunjungan','breadcrumbs'));
    }

    public function pendaftaran($id){
        $pasien = Pasien::findOrFail($id);
        $poli = Poliklinik::all();
        $dokter = Dokter::all();
        $breadcrumbs = [
            ['label' => 'Pasien', 'url' => route('dashboard.kunjungan.index')],
            ['label' =>  $pasien->nama, 'url' => route('details', $id)],
            ['label' => 'Pendaftaran', 'url' => route('pendaftaran', $id)],
        ];
        return view('dashboard.kunjungan.kunjunganPasien', compact('dokter','pasien','poli','breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pasien_id' => 'required|exists:pasien,id',
            'poli_id' => 'required|exists:poliklinik,id',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi!');
        }
        $kunjungan=Kunjungan::create([
            'pasien_id' => $request->pasien_id,
            'poli_id' => $request->poli_id,
            'tanggal_kunjungan' => now(),
            'jam_kunjungan' => Carbon::now()->format('H:i:s'),
            'status_kunjungan' => 'Menunggu',
        ]);
        return redirect('/kunjungan')->with('success', 'Berhasil menambahkan kunjungan pasien!');
    }

    public function destroy($id)
    {
        $user = Kunjungan::findOrFail($id);
        $user->delete();

    }
}
