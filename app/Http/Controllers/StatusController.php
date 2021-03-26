<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;

class StatusController extends Controller
{
    // get all data status
    public function getStatus()
    {
        $data = Status::get();
        return response()->json(
            [
                'succes' => true,
                'status' => 200,
                'message' => 'All Status',
                'result' => $data,
            ],
            200
        );
    }
}
