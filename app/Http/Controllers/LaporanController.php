<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laporan;

class LaporanController extends Controller
{
    // get all data
    public function getLaporan()
    {
        $data = Laporan::all();
        return response()->json(
            [
                'succes' => true,
                'status' => 200,
                'message' => 'All Laporan',
                'result' => $data,
            ],
            200
        );
    }

    // create data
    public function createLaporan(Request $request)
    {
        // get image
        if ($request->hasFile('foto_laporan')) {
            $original_filename = $request
                ->file('foto_laporan')
                ->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/fotolaporan/';
            $image = 'A-' . time() . '.' . $file_ext;
            $request->file('foto_laporan')->move($destination_path, $image);
            $fotolaporan = 'http://localhost:8000/upload/fotolaporan/' . $image;
        }

        // get data
        $nik = $request->input('nik');
        $tglpengaduan = $request->input('tgl_pengaduan');
        $isilaporan = $request->input('isi_laporan');
        $status = $request->input('status');

        // data
        $data = [
            'nik' => $nik,
            'tgl_pengaduan' => $tglpengaduan,
            'isi_laporan' => $isilaporan,
            'foto_laporan' => $fotolaporan,
            'status' => $status,
        ];

        if (Laporan::create($data)) {
            return response()->json(
                [
                    'success' => true,
                    'status' => 200,
                    'message' => 'Laporan was created successfully',
                    'data' => $data,
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'success' => false,
                    'status' => 404,
                    'message' => 'Laporan created failed',
                    'data' => $data,
                ],
                200
            );
        }
    }
}
