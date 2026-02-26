<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Number;

class KelolaPetugasController extends Controller
{
    public function index() {
        $data = User::all();
        return view('admin.petugas.kelola-petugas', compact('data'));
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'username' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string|min:6',
            ]);

            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            return redirect('/kelola-petugas')->with(['success' => "Data Petugas {$request->name} Berhasil Dimasukan"]);
        } catch (\Exception $error) {
            return redirect()->back()
                ->with('error', 'Gagal Input Data!')
                ->withInput();
        }
    }

    public function update(Request $request, $id) {
        try {
            $request->validate([
                'username' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'nullable|string|min:6',
            ]);

            $petugas = User::findOrFail($id);
            $petugas->update([
                'username' => $request->username,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : $petugas->password,
            ]);

            return redirect('/kelola-petugas')->with(['success' => "Data Petugas {$request->name} Berhasil Diperbarui"]);
        } catch (\Exception $error) {
            return redirect()->back()
                ->with('error', 'Gagal Update Data!')
                ->withInput();
        }
    }

    public function destroy(Number $id) {
        try {
            $petugas = User::findOrFail($id);
            $petugas->delete();

            return redirect('/kelola-petugas')->with(['success' => "Data Petugas {$petugas->name} Berhasil Dihapus"]);
        } catch (\Exception $error) {
            return redirect()->back()
                ->with('error', 'Gagal Hapus Data!');
        }
    }
}
