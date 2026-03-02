<?php

namespace App\Http\Controllers;

use App\Models\JenisKelamin;
use App\Models\Pasien;
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
        $title = 'Kelola Jenis Kelamin';

        // Hitung jumlah pasien dan tambahkan styling berdasarkan jenis kelamin
        foreach ($data as $d) {
            $d->count = Pasien::where('jenis_kelamin_id', $d->id)->count();

            // Set styling berdasarkan jenis kelamin
            if ($d->deskripsi == 'Laki-laki') {
                $d->bgGradient = 'linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%)';
                $d->iconColor = '#0284c7';
                $d->textColor = '#0c4a6e';
                $d->icon = 'bi-gender-male';
                $d->subText = 'Pria dewasa/remaja';
            } else {
                $d->bgGradient = 'linear-gradient(135deg, #fce7f3 0%, #fbcfe8 100%)';
                $d->iconColor = '#ec4899';
                $d->textColor = '#831843';
                $d->icon = 'bi-gender-female';
                $d->subText = 'Wanita dewasa/remaja';
            }
        }

        return view('admin.JenisKelamin.kelola-jenis-kelamin', compact('data', 'title'));
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

