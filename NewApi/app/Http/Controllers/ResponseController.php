<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Responses;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function store(Request $request , $slug){
             
        
        $form = Form::where('slug',$slug)->first();
    
        if(!$form){
            return response()->json([
                'Message' => 'Form Not Found'
            ]);
        }

        // validasi
        $request->validate([
            'email' => [
                'required',
                'email',

                function ($attribute,$value, $fail) {
                    $allowedDomains = ['webtech.id', 'inaskills.id'];
                    $domain = substr(strrchr($value, "@"), 1);
                    if (!in_array($domain, $allowedDomains)) {
                        $fail('Domain email tidak diperbolehkan.');
                    }
                }
            ],
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|integer',
            'answers.*.value' => 'required|string'
        ]);

         Responses::create([
            'email' => $request->email, 
            'form_id' => $form->id,
            'answers' => $request->answers
        ]);
        
        return response()->json([
            'message' => 'Submit response success'
        ]);
    }

    public function getResponse($slug){

        $form = Form::where('slug',$slug)->first();

        if(!$form){
            return response()->json([
                'message' => 'form Not Found'
            ]);
        }
        $response = Responses::all();

        return response()->json([
            'message' => 'Get respone Succes',
            'responses' => [$response]
        ]);
    }
         
    }

