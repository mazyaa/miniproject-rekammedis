<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $table = 'pasien';

    protected $fillable = [
        'tanggal_lahir',
        'usia',
        'nik',
        'no_hp',
        'nama_pasien',
        'alamat',
        'keterangan',
        'desa_id',
        'jenis_kelamin_id'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function jenisKelamin()
    {
        return $this->belongsTo(JenisKelamin::class);
    }

    // using hasMany because one patient can have multiple medical records
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class);
    }
}
