<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    // get all
    public function location()
    {
        $data = Location::all();
        return response()->json(
            [
                'success' => true,
                'status' => 200,
                'message' => 'All Location',
                'result' => $data,
            ],
            200
        );
    }
}
