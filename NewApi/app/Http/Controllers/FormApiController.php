<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\User;
use Illuminate\Http\Request;

class FormApiController extends Controller
{
    //
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:forms,slug',
            'allowed_domains' => 'array'
        ]);

        // mengambil data dari midwalre user
        $user = $request->user;

        $form = Form::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'allowed_domains' => json_encode($request->allowed_domains),
            'description' => $request->description,
            'limit_one_response' => $request->limit_one_response,
            // dari table user
            'creator_id' => $user->id
        ]);

        // kalo form nya gak jalan
        if(!$form){
            return response()->json([
                'message' => 'Invalid Field',
                'form' => $form
            ],422);
        }
        
        return response()->json([
            'message' => 'Create form success',
            'form' => $form
        ],200);
    }

    public function getform(){
        $form = Form::all();
        return response()->json([
            'message' => 'Get all forms success',
            'form' => $form
        ],200);
    }

    public function detail($slug){
        $form = Form::where('slug',$slug)->first();

        if(!$form){
            return response()->json([
                'message' => 'Form not found',
                'form' => $form
            ],404);
        }

        return response()->json([
            'message' => 'Get form success',
            'form' => $form
        ],200);
    }
}
