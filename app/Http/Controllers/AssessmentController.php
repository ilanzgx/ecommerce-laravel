<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AvailableAssessment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AssessmentController extends Controller{
    public function createAssessment(Request $request){
        try{
            $messages = [
                'title.required' => 'O campo titulo é obrigatório.',
                'text.required'  => 'O campo texto é obrigatório'
            ];

            $request->validate([
                'title' => 'required',
                'text'  => 'required' 
            ], $messages);

        } catch(ValidationException $e) {
            return json_encode(['errors' => $e->errors()]);
        }

        $dataThroughToken = AvailableAssessment::where('token', $request->token)->first();

        $new_assessment = new Assessment();

        $new_assessment->customer_id = $dataThroughToken->customer_id;
        $new_assessment->payment_id = $dataThroughToken->payment_id;
        $new_assessment->product_id = $dataThroughToken->product_id;
        $new_assessment->title = $request->title;
        $new_assessment->text = $request->text;
        $new_assessment->stars = $request->stars;

        $new_assessment->save();

        $dataThroughToken->delete();

        return json_encode(['success' => true]);
    }
}
