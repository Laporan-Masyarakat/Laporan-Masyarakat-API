<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function getRole()
    {
        $data = Role::all();
        return response()->json(
            [
                'succes' => true,
                'status' => 200,
                'message' => 'All Role',
                'result' => $data,
            ],
            200
        );
    }
}
