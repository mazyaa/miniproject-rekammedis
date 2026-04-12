<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Desa;
use App\Models\JenisKelamin;
use Illuminate\Http\Request;

class KelolaPasienController extends Controller
{
    // ! ======================= READ ===================================
    public function index()
    {
        $data = Pasien::orderBy('created_at', 'desc')->get();
        $desa = Desa::all();
        $jeniskelamin = JenisKelamin::all();
        return view('admin.Pasien.kelola-pasien', compact('data', 'desa', 'jeniskelamin'));
    }

    // ! ======================= CREATE ===================================
    public function store(Request $request)
    {
        try {
            // ? Validasi apakah data sudah sesuai dengan type tabel
            $request->validate([
                'nama_pasien' => 'required|string',
                'nik' => 'required|string',
                'jenis_kelamin_id' => 'required|integer',
                'tanggal_lahir' => 'required|date',
                'usia' => 'required|integer',
                'alamat' => 'required|string',
                'desa_id' => 'required|integer',
                'keterangan' => 'required|string'
            ]);

            Pasien::create([
                'nama_pasien' => $request->nama_pasien,
                'nik' => $request->nik,
                'jenis_kelamin_id' => $request->jenis_kelamin_id,
                'tanggal_lahir' => $request->tanggal_lahir,
                'usia' => $request->usia,
                'alamat' => $request->alamat,
                'desa_id' => $request->desa_id,
                'keterangan' => $request->keterangan,
                'no_hp' => $request->no_hp ?? null
            ]);

            // ! return
            return redirect('/kelola-pasien')->with([
                'success' => "Data Pasien {$request->nama_pasien} Berhasil Dimasukan"
            ]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal Input Data! ' . $e->getMessage())
                ->withInput();
        }
    }

    // ! ======================= UPDATE ===================================
    public function update(Request $request, $id)
    {
        try {
            // ? Validasi
            $request->validate([
                'nama_pasien' => 'required|string',
                'nik' => 'required|string',
                'jenis_kelamin_id' => 'required|integer',
                'tanggal_lahir' => 'required|date',
                'usia' => 'required|integer',
                'alamat' => 'required|string',
                'desa_id' => 'required|integer',
                'keterangan' => 'required|string'
            ]);

            // ? Cari data berdasarkan ID
            $pasien = Pasien::findOrFail($id);

            // ? Update data
            $pasien->update([
                'nama_pasien' => $request->nama_pasien,
                'nik' => $request->nik,
                'jenis_kelamin_id' => $request->jenis_kelamin_id,
                'tanggal_lahir' => $request->tanggal_lahir,
                'usia' => $request->usia,
                'alamat' => $request->alamat,
                'desa_id' => $request->desa_id,
                'keterangan' => $request->keterangan,
                'no_hp' => $request->no_hp ?? null
            ]);

            // ! Return
            return redirect('/kelola-pasien')->with([
                'success' => "Data Pasien {$request->nama_pasien} Berhasil Diperbarui"
            ]);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal Update Data! ' . $e->getMessage())
                ->withInput();
        }
    }

    // ! ======================= DELETE ===================================
    public function destroy($id)
    {
        try {
            $pasien = Pasien::findOrFail($id);
            $nama = $pasien->nama_pasien;
            $pasien->delete();
            return redirect()->back()->with('success', "Data Pasien {$nama} Berhasil Dihapus");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Menghapus Data!');
        }
    }
}
