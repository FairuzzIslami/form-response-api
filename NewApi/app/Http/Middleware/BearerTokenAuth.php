<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class BearerTokenAuth
{
    public function handle(Request $request, Closure $next)
    {

        // jika user ingin logut

        // Di header posman
        // key : Authorization
        // value : Bearer token user (sesaui kolom nama dan email login user)

        // Ambil token dari header Authorization
        $token = $request->bearerToken();

        // Cari user berdasarkan token
        // Di sini sistem mencari user yang memiliki token sesuai data di database.
        //➡️   Jika ditemukan, berarti token valid.
        // ➡️ Jika tidak ditemukan, berarti token tidak valid atau sudah kedaluwarsa.
        $user = User::where('token', $token)->first();

        // jika gak ada
        // token nya invalid
        if (!$user) {
            return response()->json([
                'message' => 'Unauthorized access. Invalid token.'
            ],401);
            // 401 respone http
        }

        // Set user ke request agar bisa diakses di controller
        $request->merge(['user' => $user]);

        return $next($request);
    }
}
