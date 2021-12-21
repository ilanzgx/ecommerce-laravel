<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AssessmentController extends Controller{
    public function createAssessment(Request $request){
        try{
            $messages = [
                'title.required' => 'O campo titulo é obrigatório.',
                'text.required'  => 'O campo texto é obrigatório'
            ];

            $validator = $request->validate([
                'title' => 'required',
                'text'  => 'required' 
            ], $messages);

        } catch(ValidationException $e) {
            return json_encode(['errors' => $e->errors()]);
        }

        $new_assessment = new Assessment();

        $new_assessment->title = $request->title;
        $new_assessment->text = $request->text;
        $new_assessment->stars = $request->stars;

        $new_assessment->save();

        return json_encode(['success' => true]);
    }
}
