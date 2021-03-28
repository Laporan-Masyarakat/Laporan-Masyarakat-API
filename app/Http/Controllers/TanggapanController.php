<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tanggapan;

class TanggapanController extends Controller
{
    // data tanggapan
    public function getTanggapan()
    {
        $data = Tanggapan::with('id_pengaduan')->get();
        return response()->json(
            [
                'succes' => true,
                'status' => 200,
                'message' => 'All Tanggapan',
                'result' => $data,
            ],
            200
        );
    }

    // create tanggapan
    public function createTanggapan(Request $request)
    {
        // get data
        $idpengaduan = $request->input('id_pengaduan');
        $isitanggapan = $request->input('isi_tanggapan');
        $iduser = $request->input('id_user');

        // data
        $data = [
            'id_pengaduan' => $idpengaduan,
            'isi_tanggapan' => $isitanggapan,
            'id_user' => $iduser,
        ];

        if (Tanggapan::create($data)) {
            return response()->json(
                [
                    'success' => true,
                    'status' => 200,
                    'message' => 'Tanggapan was created successfully',
                    'data' => $data,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'status' => 404,
                    'message' => 'Tanggapan created failed',
                    'data' => $data,
                ],
                200
            );
        }
    }

    // delete data
    public function deleteTanggapan($id)
    {
        $data = Tanggapan::where('id', $id)->first();
        $data->delete();

        return response('Berhasil Menghapus Tanggapan');
    }
}
