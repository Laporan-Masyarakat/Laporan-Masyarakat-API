<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instansi;

class InstansiController extends Controller
{
    public function getInstansi()
    {
        $data = Instansi::get();
        return response()->json(
            [
                'succes' => true,
                'status' => 200,
                'message' => 'All Instansi',
                'result' => $data,
            ],
            200
        );
    }
}
