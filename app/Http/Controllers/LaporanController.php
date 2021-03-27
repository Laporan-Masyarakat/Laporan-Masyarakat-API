<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Laporan;

class LaporanController extends Controller
{
    // get all data
    public function getLaporan()
    {
        $data = Laporan::with('status', 'kategori_laporan')->get();
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
        $judullaporan = $request->input('judul_laporan');
        $tglpengaduan = $request->input('tgl_pengaduan');
        $isilaporan = $request->input('isi_laporan');
        $instansi = $request->input('instansi_tujuan');
        $kategorilaporan = $request->input('kategori_laporan');
        $lokasikejadian = $request->input('lokasi_kejadian');

        // data
        $data = [
            'judul_laporan' => $judullaporan,
            'isi_laporan' => $isilaporan,
            'tgl_pengaduan' => $tglpengaduan,
            'lokasi_kejadian' => $lokasikejadian,
            'instansi_tujuan' => $instansi,
            'kategori_laporan' => $kategorilaporan,
            'foto_laporan' => $fotolaporan,
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

    // get data per id
    public function getDataId($id)
    {
        $data = Laporan::where('id', $id)
            ->with('status')
            ->get();
        return response()->json(
            [
                'success' => true,
                'status' => 200,
                'message' => 'Data Laporan',
                'data' => $data,
            ],
            200
        );
    }

    // update status verifify
    public function updateStatus(Request $request, $id)
    {
        $data = Laporan::find($id);

        $data->update([
            'status' => $request->status,
        ]);

        return response()->json(
            [
                'success' => true,
                'status' => 200,
                'message' => 'Status Update Succesfully',
            ],
            200
        );
    }
}
