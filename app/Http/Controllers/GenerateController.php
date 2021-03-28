<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Laporan;

class GenerateController extends Controller
{
    public function printPDF()
    {
        if (isset($_GET['pdf'])) {
            $data = Laporan::all();
            $pdf = PDF::loadView('pdf', ['data' => $data])->setPaper(
                'a4',
                'landscape'
            );
            $pdf
                ->getDomPdf()
                ->getOptions()
                ->set('enable_php', true);
            return $pdf->download('datalaporan.pdf');
        }

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Data Report Pdf',
        ]);
    }

    public function view()
    {
        $data = Laporan::all();

        return view('pdf', compact('data'));
    }
}
