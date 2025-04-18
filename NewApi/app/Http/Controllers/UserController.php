<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // index
    public function index(){
        $list = User::all();
        return response()->json([
            'status' => 'success',
            'data' => $list
        ]);
    }
    // slug kata kunci judul

    // first dan find

    // all dan get 
}
