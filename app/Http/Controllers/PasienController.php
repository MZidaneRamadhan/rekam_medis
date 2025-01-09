<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['label' => 'Pasien', 'url' => route('dashboard.pasien.index')],
        ];
        $pasien = Pasien::all();
        return view('dashboard.pasien.index', compact('pasien','breadcrumbs'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|unique:pasien,nik',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'telp' => 'required|string|',
            'agama' => 'required|string|max:50',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi!');
        }
        $tanggal_lahir = Carbon::parse($request->tanggal_lahir);
        $usia = $tanggal_lahir->diffInYears(Carbon::now());

        $pasien=Pasien::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'usia' => $usia,
            'jenis_kelamin' => $request->jenis_kelamin,
            'telp' => $request->telp,
            'agama' => $request->agama,
        ]);
        return redirect('/pasien')->with('success', 'Data Pasien berhasil ditambahkan!');
    }
    public function show($id)
    {
        $pasien = Pasien::with('rekamMedis','kunjungan')->findOrFail($id);
        $breadcrumbs = [
            ['label' => 'Pasien', 'url' => route('dashboard.pasien.index')],
            ['label' =>  $pasien->nama, 'url' => route('details', $id)],
        ];
        return view('dashboard.pasien.details', compact('pasien','breadcrumbs'));

    }

    public function destroy($id)
    {
        $pasien = Pasien::findOrFail($id);
        $pasien->delete();

        return redirect('/pasien')->with('success', 'Data Pasien berhasil dihapus!');;
    }
}
