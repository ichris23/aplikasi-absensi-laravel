<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KonfigurasiController extends Controller
{
    public function lokasikantor()
    {
        $lok_kantor = DB::table('konfigurasi_lokasi')->where('id', 1)->first();

        return view('konfigurasi.lokasikantor', compact('lok_kantor'));
    }

    public function updatelokasikantor(Request $request)
    {
        $lokasi_kantor = $request->lokasi_kantor;
        $radius = $request->radius;
        $data = [
            'lokasi_kantor' => $lokasi_kantor,
            'radius' => $radius
        ];

        $update = DB::table('konfigurasi_lokasi')->where('id', 1)->update($data);

        if ($update) {
            return Redirect::back()->with('success', 'Update Lokasi Berhasil');
        } else {
            return Redirect::back()->with('failed', 'Update Lokasi Gagal');
        }
    }
}
