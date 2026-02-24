<?php

namespace App\Http\Controllers;

use App\Models\JenisKelamin;
use Illuminate\Http\Request;

class KelolaJenisKelaminController extends Controller
{
    // ! ============================ CREATE ===================================================
    public function store(Request $request)
    {
        try {
            // ? Validasi apakah data sudah sesuai dengan type tabel
            $request->validate([
                'deskripsi' => 'required|string'
            ]);
            // dd($request->toArray());
            JenisKelamin::create([
                'deskripsi' => $request->deskripsi
            ]);

            // ! return
            return redirect('/kelola-jenis-kelamin')->with([
                'success' => "Data Jenis Kelamin {$request->deskripsi} Berhasil Dimasukan"
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal Input Data!')
                ->withInput();
        }
    }

    // ! ============================ READ ===================================================
    public function index()
    {
        $data = JenisKelamin::all();
        return view('admin.JenisKelamin.kelola-jenis-kelamin', compact('data'));
    }

    // ! ======================= UPDATE ===================================
    public function update(Request $request, $id)
    {
        try {
            // ? Validasi
            $request->validate([
                'deskripsi' => 'required|string'
            ]);

            // ? Cari data berdasarkan ID
            $jeniskelamin = JenisKelamin::findOrFail($id);

            // ? Update data
            $jeniskelamin->update([
                'deskripsi' => $request->deskripsi
            ]);

            // ! Return
            return redirect('/kelola-jenis-kelamin')->with([
                'success' => "Data Jenis Kelamin {$request->deskripsi} Berhasil Diperbarui"
            ]);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal Update Data!')
                ->withInput();
        }
    }

        // ! ======================= DELETE ===================================

     public function destroy($id)
    {
        JenisKelamin::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}

