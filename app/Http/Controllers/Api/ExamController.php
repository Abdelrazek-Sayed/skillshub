<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function show($id)
    {
        $exam = Exam::findOrFail($id);
        return new ExamResource($exam);
    } 


    public function showQuestions($id)
    {
        $exam = Exam::with('questions')->findOrFail($id);
        return new ExamResource($exam);
    }

        public function start($examId,Request $request)
        {
                    //  dd($request->user());
            $request->user()->exams()->attach($examId);

            return response()->json([
                'messege' => 'you started exam'
            ]);
        }
    
    
    public function submit($examId,Request $request)
   
    {
 
      $validator = Validator::make($request->all(),[
          
          'answers' => 'required|array',
          'answers.*' => 'required|in:1,2,3,4',
      ]);  

     if($validator->fails()){
          return response()->json($validator->errors());
          }
     
           $exam = Exam::findOrFail($examId);

            // calculating score
            $point = 0;
            $questionNum = $exam->questions->count();

            foreach($exam->questions as $question){

            if(isset($request->answers[$question->id])){
             $userAns = $request->answers[$question->id];
            $rightAns = $question->right_ans;

            if($userAns == $rightAns)
            $point += 1;

            }
            }
         
            $score = ($point/$questionNum)*100;

         //   return response()->json($score);

       $user = $request->user();
       $pivotRow = $user->exams()->where('exam_id',$examId)->first();
       $startTime = $pivotRow->pivot->created_at;
       $submitTime = Carbon::now();

       $timeMin = $submitTime->diffInMinutes($startTime);
       if($timeMin > $pivotRow->duration_mins){
           $score = 0;
       }

    //    // update pivot table

       $user->exams()->updateExistingPivot($examId,[
           'score' => $score,
           'time_mins'=> $timeMin,
       ]);
    return response()->json([
        'messege'  => "you submitted exam succefully and ypur score is $score",
    ]); 
    }
}
