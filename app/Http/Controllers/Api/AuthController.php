<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // membuat validasi
        $validator = Validator::make($request->all(), [
            'name' => 'required', // name bersifat required/wajib
            'email' => 'required|email|unique:users,email', // email bersifat required dan harus sesuai format email, dan email bersifat unique/tidak boleh sama dengan yang sudah ada di database
            'password' => 'required|min:8', // password bersifat required dan memiliki panjang minimal 8 karakter
        ]);

        // jika validasi gagal, maka akan mengembalikan response berupa error
        if ($validator->fails()) {
            return response()->json($validator->errors());
        }


        // user::create untuk membuat user baru
        $user = User::create([
            'name' => $request->name, // ambil name dari request
            'email' => $request->email, // ambil email dari request
            'password' => bcrypt($request->password), // ambil password dari request
        ]);
        // fungsi bcyrpt: password -> hashed

        // buat token untuk user yang baru saja dibuat
        $token = $user->createToken('auth_token')->plainTextToken;

        // kembalikan response dalam bentuk json
        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    // fungsi login
    public function login(Request $request)
    {
        // autentikasi user, auth:attempt akan mengembalikan nilai true jika berhasil login
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Email atau password salah'
            ], 401);
        }

        // jika email dan password benar
        $user = User::where('email', $request->email)->firstOrFail();

        // buat token untuk user yang baru saja login
        $token = $user->createToken('auth_token')->plainTextToken;

        // kembalikan response dalam bentuk json
        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }


    // fungsi logout
    public function logout(Request $request)
    {
        // menghapus token yang dimiliki user
        $request->user()->currentAccessToken()->delete();

        // kembalikan response dalam bentuk json
        return response()->json([
            'message' => 'Berhasil logout'
        ]);
    }
}
