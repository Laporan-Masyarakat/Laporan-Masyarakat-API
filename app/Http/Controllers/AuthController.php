<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\User;

class AuthController extends Controller
{
    // register user
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

    // generate random string for token
    function generateRandomString($length = 80)
    {
        $karakkter =
            '012345678dssd9abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $panjang_karakter = strlen($karakkter);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $karakkter[rand(0, $panjang_karakter - 1)];
        }
        return $str;
    }

    // login user
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
            $newtoken = $this->generateRandomString();

            $user->update([
                'token' => $newtoken,
            ]);

            $out = [
                'success' => true,
                'message' => 'login_success',
                'code' => 200,
                'result' => [
                    'username' => $user->username,
                    'token' => $newtoken,
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
                    'token' => null,
                    'role' => null,
                    'iduser' => null,
                ],
            ];
        }

        return response()->json($out, $out['code']);
    }

    // logout user
    public function logoutUser(Request $data)
    {
        $token = explode(' ', $data->header('Authorization'));
        $user = User::where('token', $token[1])->first();
        if ($user) {
            $user->token = null;
            $user->save();
            return response()->json(
                [
                    'success' => true,
                    'status' => 200,
                    'message' => 'Success Logout',
                    'data' => $user,
                ],
                200
            );
        }
        return response()->json(
            [
                'success' => false,
                'status' => 400,
                'message' => 'Failed Logout',
                'data' => '',
            ],
            200
        );
    }
}
