<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $table = 'rekam_medis';

    protected $fillable = [
        'diastolik',
        'sistolik',
        'tanggal_kunjungan',
        'pasien_id',
        'petugas_id',
        'kepatuhan',
        'obat_diberikan',
        'keterangan'
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date'
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
