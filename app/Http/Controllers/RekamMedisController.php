<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;

use Illuminate\Http\Request;

class RekamMedisController extends Controller
{
    public function index()
    {
        $data = RekamMedis::all(); // get all records from the RekamMedis model
        return view('admin.RekamMedis.rekam-medis', compact('data')); // pass the data to the view
    }
}
