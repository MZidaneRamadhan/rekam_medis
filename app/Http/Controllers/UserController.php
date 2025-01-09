<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request){
        $breadcrumbs = [
            ['label' => 'User', 'url' => route('user')],
        ];
        $user = User::all();
        return view('dashboard.user.index', compact('user','breadcrumbs'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required',
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Terjadi kesalahan validasi!');
        }
        $pasien=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);
        return redirect('/user')->with('success', 'Data User berhasil ditambahkan!');
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable|string',
            'email' => 'nullable|email|max:255',
            'password' => 'nullable|max:255',
            'role' => 'nullable',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password, // Hash password jika ada
            'role' => $request->role,
        ]);

        return redirect('/user')->with('success', 'Data User berhasil diperbarui!');
    }
}
