<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

class AuthController extends Controller
{
    // Register User
    public function registerUser(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6',
        ]);

        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');

        $hashPwd = Hash::make($password);

        $data = [
            'username' => $username,
            'email' => $email,
            'password' => $hashPwd,
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

    // Login User
    public function loginUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $out = [
                'message' => 'login_failed',
                'code' => 401,
                'result' => [
                    'token' => null,
                ],
            ];
            return response()->json($out, $out['code']);
        }

        if (Hash::check($password, $user->password)) {
            $out = [
                'success' => true,
                'message' => 'login_success',
                'code' => 200,
                'result' => [
                    'username' => $user->username,
                    'role' => $user->role,
                    'iduser' => $user->id,
                ],
            ];
        } else {
            $out = [
                'success' => true,
                'message' => 'login_failed',
                'code' => 401,
                'result' => [
                    'username' => null,
                ],
            ];
        }

        return response()->json($out, $out['code']);
    }
}
