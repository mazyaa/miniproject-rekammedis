<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory; 
    protected $table = 'desa'; // use protected $table to specify the table name

    protected $fillable = [ // mandatory to specify fillable fields for mass assignment
        'nama_desa'
    ];

    // Define the relationship with Pasien model
    public function pasien()
    {
        return $this->hasMany(Pasien::class);
    }
}
