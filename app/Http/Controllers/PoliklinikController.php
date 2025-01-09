<?php

namespace App\Http\Controllers;

use App\Models\Poliklinik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoliklinikController extends Controller
{
    public function index(){
        $breadcrumbs = [
            ['label' => 'Poli', 'url' => route('dashboard.poli.index')],
        ];
        $poli = Poliklinik::all();
        return view('dashboard.poli.index', compact('poli','breadcrumbs'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_poli'     => 'required',
            'ruangan'     => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        Poliklinik::create([
            'nama_poli'  => $request->nama_poli,
            'ruangan'  => $request->ruangan,
        ]);
        return redirect('/poli')->with('success', 'Data Poli berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_poli' => 'required|string|unique:poliklinik,nama_poli,' . $id,
            'ruangan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi!');
        }

        $tindakan = Poliklinik::findOrFail($id);

        $tindakan->update([
            'nama_poli' => $request->nama_poli,
            'ruangan' => $request->ruangan,
        ]);

        return redirect('/poli')->with('success', 'Data Poli berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $poli = Poliklinik::findOrFail($id);
        $poli->delete();

        return redirect()->route('dashboard.poli.index')->with('success', 'Data berhasil dihapus.');
    }
}
