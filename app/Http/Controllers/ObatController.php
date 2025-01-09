<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ObatController extends Controller
{
    public function index(){
        $obat = Obat::paginate(20);
        $breadcrumbs = [
            ['label' => 'Obat', 'url' => route('dashboard.obat.index')],
        ];
        return view('dashboard.obat.index', compact('obat','breadcrumbs'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_obat'     => 'required|unique:obat,nama_obat',
            'jumlah_obat'     => 'required',
            'harga'     => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('dialog_open', true);;
        }

        Obat::create([
            'nama_obat'  => $request->nama_obat,
            'jumlah_obat'  => $request->jumlah_obat,
            'harga'  => $request->harga,
        ]);
        return redirect('/obat')->with('success', 'Data Obat berhasil ditambahkan!');;
    }
    public function update(Request $request,$id)
    {
        $obat = Obat::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_obat'    => 'required|string',
            'jumlah_obat'  => 'required',
            'harga'        => 'required',
        ]);

        $obat->update([
            'nama_obat'    => $request->nama_obat,
            'jumlah_obat'  => $request->jumlah_obat,
            'harga'        => $request->harga,
        ]);
        return redirect('/obat')->with('success', 'Data Obat berhasil dihapus!');;
    }
    public function destroy($id)
    {
        $user = Obat::findOrFail($id);
        $user->delete();
        return redirect('/obat')->with('success', 'Data Obat berhasil dihapus!');;
    }
}
