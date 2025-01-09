<?php

namespace App\Http\Controllers;

use App\Models\Tindakan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TindakanController extends Controller
{
    public function index(Request $request){
        $query = Tindakan::query();

        // Jika ada pencarian, tambahkan filter
        if ($request->has('search') && !empty($request->search)) {
            $query->where('nama_tindakan', 'like', '%' . $request->search . '%')
                ->orWhere('keterangan', 'like', '%' . $request->search . '%');
        }

        // Gunakan paginate untuk hasil akhir
        $tindakan = $query->paginate(10);

        // Tambahkan parameter pencarian ke link pagination
        $tindakan->appends($request->all());

        $breadcrumbs = [
            ['label' => 'Tindakan', 'url' => route('dashboard.tindakan.index')],
        ];
        return view('dashboard.tindakan.index', compact('tindakan','breadcrumbs'));

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_tindakan' => 'required|string|unique:tindakan,nama_tindakan',
            'keterangan' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi!');
        }

        $tindakan=Tindakan::create([
            'nama_tindakan' => $request->nama_tindakan,
            'keterangan' => $request->keterangan,
        ]);
        return redirect('/tindakan')->with('success', 'Data Tindakan berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_tindakan' => 'required|string|unique:tindakan,nama_tindakan,' . $id,
            'keterangan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi!');
        }

        $tindakan = Tindakan::findOrFail($id);

        $tindakan->update([
            'nama_tindakan' => $request->nama_tindakan,
            'keterangan' => $request->keterangan,
        ]);

        return redirect('/tindakan')->with('success', 'Data Tindakan berhasil diperbarui!');
    }
    public function destroy($id)
    {
        $tindakan = Tindakan::findOrFail($id);
        $tindakan->delete();
        return redirect('/tindakan')->with('success', 'Data Tindakan berhasil dihapus!');;

    }
}
