<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        // ambil email dan pw dari db yg udah ada
        $credentials = $request->only('email', 'password');
        
        // meng cek jika data nya benar dari
        // email dan pw di db
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // akan membuat token baru secara acak
            // Generate token secara otomatis
            $token = Str::random(60);

            // di upload di db bagian token
            $user->update(['token' => $token]);

            return response()->json([
                'message' => 'Login success',
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email,
                    'accessToken' => $token,
                    'password' => $user->password
                ]
            ], 200);
        }

        return response()->json([
            'message' => 'Email or password incorrect'
        ], 401);
    }

    // Logout
    public function logout(Request $request)
    {
        // dari midwalre ke controller sini

        // menyimpan table user login 

        if(Session::get('email')==null){
            $email = $request->email; 
        }else{
            $email = Auth::user()->email;
        };

        // ambil data dari pengguna yg login tadi
        $user = User::where('email',$email)->first();


        // lalu token akan di hapus di db
        if ($user) {
            $user->update(['token' => null]);
            $user->save();
        }

        return response()->json([
            'message' => 'Logout success'
        ], 200);
    }
    
}
