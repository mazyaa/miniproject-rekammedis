<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\Request;

class KelolaDesaController extends Controller
{

    // ! ======================= CREATE ===================================
    public function store(Request $request)
    {
        try {
            // ? Validasi apakah data sudah sesuai dengan type tabel
            $request->validate([
                'nama_desa' => 'required|string'
            ]);
            // dd($request->toArray());
            Desa::create([
                'nama_desa' => $request->nama_desa
            ]);

            // ! return
            return redirect('/kelola-desa')->with([
                'success' => "Data Desa {$request->nama_desa} Berhasil Dimasukan"
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal Input Data!')
                ->withInput();
        }
    }


    // ! ======================= READ ===================================
    public function index()
    {
        $data = Desa::all();
        return view('admin.desa.kelola-desa', compact('data'));
    }


    // ! ======================= UPDATE ===================================
    public function update(Request $request, $id)
    {
        try {
            // ? Validasi
            $request->validate([
                'nama_desa' => 'required|string'
            ]);

            // ? Cari data berdasarkan ID
            $desa = Desa::findOrFail($id);

            // ? Update data
            $desa->update([
                'nama_desa' => $request->nama_desa
            ]);

            // ! Return
            return redirect('/kelola-desa')->with([
                'success' => "Data Desa {$request->nama_desa} Berhasil Diperbarui"
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
        Desa::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }
}
