<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriLaporan;

class KategoriController extends Controller
{
    public function getKategori()
    {
        $data = KategoriLaporan::get();
        return response()->json(
            [
                'succes' => true,
                'status' => 200,
                'message' => 'All Kategori Laporan',
                'result' => $data,
            ],
            200
        );
    }
}
