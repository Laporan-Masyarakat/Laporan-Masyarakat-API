<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    public function getUser()
    {
        $data = User::with('role')->get();
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

    public function createUser(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6',
            'role' => 'required',
        ]);

        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');
        $role = $request->input('role');

        $hashPwd = Hash::make($password);

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $hashPwd,
            'role' => $role,
        ];

        if (User::create($data)) {
            $out = [
                'success' => true,
                'message' => 'register_success',
                'code' => 200,
            ];
        } else {
            $out = [
                'success' => false,
                'message' => 'failed_regiser',
                'code' => 404,
            ];
        }

        return response()->json($out, $out['code']);
    }
}
