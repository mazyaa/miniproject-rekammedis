<?php

namespace App\Http\Controllers;

use App\Models\JenisKelamin;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\User;

use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $data = RekamMedis::with(['pasien', 'petugas', 'pasien.jenisKelamin'])
            ->latest('tanggal_kunjungan')
            ->get();
        $pasien = Pasien::orderBy('nama_pasien')->get();
        $petugas = User::orderBy('username')->get();

        return view('admin.RekamMedis.rekam-medis', compact('data', 'pasien', 'petugas'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'diastolik' => 'required|integer',
                'sistolik' => 'required|integer',
                'tanggal_kunjungan' => 'required|date',
                'pasien_id' => 'required|integer|exists:pasien,id',
                'petugas_id' => 'required|integer|exists:users,id',
                'kepatuhan' => 'required|string',
                'obat_diberikan' => 'required|string',
                'keterangan' => 'nullable|string'
            ]);

            RekamMedis::create([
                'diastolik' => $request->diastolik,
                'sistolik' => $request->sistolik,
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'pasien_id' => $request->pasien_id,
                'petugas_id' => $request->petugas_id,
                'kepatuhan' => $request->kepatuhan,
                'obat_diberikan' => $request->obat_diberikan,
                'keterangan' => $request->keterangan
            ]);

            return redirect('/rekam-medis')->with(['success' => "Data Rekam Medis Berhasil Dimasukan"]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal Input Data! ' . $e->getMessage())
                ->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'diastolik' => 'required|integer',
                'sistolik' => 'required|integer',
                'tanggal_kunjungan' => 'required|date',
                'pasien_id' => 'required|integer|exists:pasien,id',
                'petugas_id' => 'required|integer|exists:users,id',
                'kepatuhan' => 'required|string',
                'obat_diberikan' => 'required|string',
                'keterangan' => 'nullable|string'
            ]);

            $rekamMedis = RekamMedis::findOrFail($id);

            $rekamMedis->update([
                'diastolik' => $request->diastolik,
                'sistolik' => $request->sistolik,
                'tanggal_kunjungan' => $request->tanggal_kunjungan,
                'pasien_id' => $request->pasien_id,
                'petugas_id' => $request->petugas_id,
                'kepatuhan' => $request->kepatuhan,
                'obat_diberikan' => $request->obat_diberikan,
                'keterangan' => $request->keterangan
            ]);

            return redirect('/rekam-medis')->with(['success' => "Data Rekam Medis Berhasil Diperbarui"]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal Update Data! ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $rekamMedis = RekamMedis::findOrFail($id);
            $rekamMedis->delete();
            return redirect()->back()->with(['success' => "Data Rekam Medis Berhasil Dihapus"]);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal Hapus Data! ' . $e->getMessage());
        }
    }
}
