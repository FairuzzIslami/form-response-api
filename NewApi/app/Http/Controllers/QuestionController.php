<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store( Request $Request,$slug ){
        // dari url soal nya dari form 
        // column slug
        $form = Form::where('slug',$slug)->first();

        if(!$form){
            return response()->json([
                'message' => 'Form not Found'
            ],404);
        }

        // validasi question
        $Request->validate([
            'name' => 'required',
            'choice_type' => 'required|in:short answer,paragraph,date,multiple choice,dropdown,checkboxes',
            'choices' => 'required_if:choice_type,multiple choice,dropdown,checkboxes|array',
            'is_required' => 'required|boolean'
        ]);

        $question = Question::create([
            'name' => $Request->name,
            'choice_type' => $Request->choice_type,
            'choices' => json_encode($Request->choices), // Ubah array jadi string,
            'is_required' => $Request->is_required,
            // form
            'form_id' => $form->id
        ]);

        if(!$question){
            return response()->json([
                'message' => 'Invalid Field',
                'erors' => $question
            ],422);
        }

         return response()->json([
            'message' => 'Add question succes',
            'erors' => $question
        ],200);
    }

    public function delete($slug,$id){
        
        // slug
        $form =  Form::where('slug',$slug)->first();

        if(!$form){
            return response()->json([
                'message' => 'Form Not Found'
            ],404);
        }

        // question id quesion dan 
        //form dari id table form
        $question = Question::where('form_id',$form->id)
                            ->where('id',$id)
                            ->first();

        if(!$question){
            return response()->json([
                'message' => 'Question not found'
            ],404);
        }

        $question->delete();
        return response()->json([
            'message' => 'Remove Question Succes'
        ],200);

    }
}
