<?php

namespace App\Http\Controllers\web;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;  

class Examcontroller extends Controller
{
    public function show($id){

    $data['exam'] = Exam::findOrFail($id);
    $user = Auth::user();
    $data['canViewStartBtn'] = true;

    if($user !== null){

        $pivotRow = $user->exams()->where('exam_id',$id)->first();
        if($pivotRow !== null and $pivotRow->pivot->status == 'closed' ){
        $data['canViewStartBtn'] = false;
              }

        }
        return view("web.exams.show")->with($data);
    }

    public function start($examId , Request $request)
    {
        $user =Auth::user();
        if(! $user->exams->contains($examId) ){
            $user->exams()->attach($examId);
        }else{
            $user->exams()->updateExistingPivot($examId,[
                'status' => 'closed',
            ]);
        }


        $request->session()->flash('prev',"start/$examId"); // protection 

       return redirect(url("exams/questions/$examId"));
    }

    public function question($examId ,Request $request){

        if(session('prev') !== "start/$examId" ){

        return redirect(url("exams/show/$examId"));
        
    }
        $data['exam'] = Exam::findOrFail($examId);
        $request->session()->flash('prev',"questions/$examId"); // protection 

        return view("web.exams.questions")->with($data);
    }



    public function submit( $examId,Request $request)
    {

        if(session('prev') !== "questions/$examId" ){
        return redirect(url("exams/show/$examId"));
        }



      $request->validate([
          'answers' => 'required|array',
          'answers.*' => 'required|in:1,2,3,4',
      ]);  
    
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


       $user = Auth::user();
       $pivotRow = $user->exams()->where('exam_id',$examId)->first();
       $startTime = $pivotRow->pivot->created_at;
       $submitTime = Carbon::now();

       $timeMin = $submitTime->diffInMinutes($startTime);
       if($timeMin > $pivotRow->duration_mins){
           $score = 0;
       }

       // update pivot table

       $user->exams()->updateExistingPivot($examId,[
           'score' => $score,
           'time_mins'=> $timeMin,
       ]);
       $request->session()->flash("success","exam finished with score $score % ");
       return redirect(url("exams/show/$examId"));
    }
    
  


}
