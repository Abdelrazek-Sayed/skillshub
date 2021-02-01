<?php

namespace App\Http\Controllers\admin;

use App\Events\ExamAddedEvent;
use Exception;
use App\Models\Exam;
use App\Models\Skill;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
 

    public function index()
    {
        $data['exams'] = Exam::orderBy('id','desc')->paginate(16);
        return view('admin.exams.index')->with($data);
    }
    public function show(Exam $exam)
    {
        $data['exam'] = $exam;
        return view('admin.exams.show')->with($data);
    }
    public function showQuestions(Exam $exam)
    {
        $data['exam'] = $exam;
        return view('admin.exams.show-questions')->with($data);
    }


    public function create()
    {
        $data['skills'] = Skill::select('id','name')->get();
        return view('admin.exams.create')->with($data);
    }




    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
                'name_en'       =>'required|string|max:50',
                'name_ar'       =>'required|string|max:50',
                'desc_en'       =>'required|string|max:5000',
                'desc_ar'       =>'required|string|max:5000',
                'skill_id'      =>'required|exists:skills,id',
                'img'           =>'required|image|max:2048',
                'questions_no'  =>'required|integer|min:1',
                'difficulty'    =>'required|integer|min:1|max:5 ',
                'duration_mins' =>'required|integer|min:1',
               
              

        ]);

        $path = Storage::putFile('exams',$request->file('img'));

            $exam = Exam::create([
            'name' => json_encode([
                'en'         => $request->name_en,       
                'ar'         => $request->name_ar,             
            ]),
            'desc' => json_encode([
                'en'         => $request->desc_en,       
                'ar'         => $request->desc_ar,             
            ]),
            'skill_id'       => $request->skill_id,
            'img'            => $path,
            'questions_no'   => $request->questions_no,
            'difficulty'     => $request->difficulty,
            'duration_mins'  => $request->duration_mins,
            'active'        => 0,
            ]);


         //   $request->session()->flash('msg',"Exam created ");
            $request->session()->flash('prev',"exam/$exam->id");
            return redirect(url("dashboard/exams/create-questions/{$exam->id}"));


        }

        public function createQuestions(Exam $exam)
        {

            if(session('prev') !== "exam/$exam->id" and session('current') !== "exam/$exam->id"){
                return redirect(url("dashboard/exams"));
            }


            $data['exam_id'] =$exam->id;
            $data['questions_no'] =$exam->questions_no;
            return view('admin.exams.create-questions')->with($data);
        }

        public function storeQuestions(Exam $exam , Request $request)
        {
          $request->session()->flash("current","exam/$exam->id");
           // dd($request->all());
           $request->validate([
               'titles'       => 'required|array',
               'titles.*'     => 'required|string|max:500',
               'right_anss'   => 'required|array',
               'right_anss.*' => 'required|in:1,2,3,4',
               'option_1s'    => 'required|array',
               'option_1s.*'  => 'required|string|max:255',
               'option_2s'    => 'required|array',
               'option_2s.*'  => 'required|string|max:255',
               'option_3s'    => 'required|array',
               'option_3s.*'  => 'required|string|max:255',
               'option_4s'    => 'required|array',
               'option_4s.*'  => 'required|string|max:255',
           ]);


           for($i=0; $i < $exam->questions_no; $i++){
                    Question::create([
                        'exam_id'   => $exam->id,
                        'title'     => $request->titles[$i],
                        'option_1'  => $request->option_1s[$i],
                        'option_2'  => $request->option_2s[$i],
                        'option_3'  => $request->option_3s[$i],
                        'option_4'  => $request->option_4s[$i],
                        'right_ans' => $request->right_anss[$i],

                    ]);
           }
          $exam->update([
              'active' => 1,
          ]);
        //    return redirect(url("dasboard/exams/show/$exam->id/questions"));

        // triggering the event
        
            event(new ExamAddedEvent);

           return redirect(url("dashboard/exams"));
        }

            public function edit(Exam $exam)
            {
                 $data['skills'] = skill::select('id','name')->get();
                 $data['exam'] = $exam;

                 return view("admin.exams.edit")->with($data);
            }
//
public function update(Exam $exam, Request $request)
{
    //dd($request->all());

    $request->validate([
            'name_en'       =>'required|string|max:50',
            'name_ar'       =>'required|string|max:50',
            'desc_en'       =>'required|string|max:5000',
            'desc_ar'       =>'required|string|max:5000',
            'skill_id'      =>'required|exists:skills,id',
            'img'           =>'nullable|image|max:2048',
           // 'questions_no'  =>'required|integer|min:1',
            'difficulty'    =>'required|integer|min:1|max:5 ',
            'duration_mins' =>'required|integer|min:1',
            ]);

            $path = $exam->img;
            if($request->hasFile('img')){
            storage::delete($path);
            $path = Storage::putFile('exams',$request->file('img'));
            }

        $exam->update([
        'name' => json_encode([
            'en'         => $request->name_en,       
            'ar'         => $request->name_ar,             
        ]),
        'desc' => json_encode([
            'en'         => $request->desc_en,       
            'ar'         => $request->desc_ar,             
        ]),
        'skill_id'       => $request->skill_id,
        'img'            => $path,
        'difficulty'     => $request->difficulty,
        'duration_mins'  => $request->duration_mins,
        // 'questions_no'   => $request->questions_no,
        // 'active'        => 0,
        ]);


        //   $request->session()->flash('prev',"exam/$exam->id");
        $request->session()->flash('msg',"Exam updated");
        return redirect(url("dashboard/exams/show/$exam->id"));


    }   

public function  editQuestion(Exam $exam,Question $question){
    $data['exam'] = $exam;
    $data['ques'] = $question;
    return view("admin.exams.edit-question")->with($data);
}

public function  updateQuestion(Exam $exam,Question $question,Request $request){

   //$ques = Question::findOrFail($id);
   $data = $request->validate([
        'titles'       => 'required|string|max:500',
        'right_anss'   => 'required|in:1,2,3,4',
        'option_1s'    => 'required|string|max:255',
        'option_2s'    => 'required|string|max:255',
        'option_3s'    => 'required|string|max:255',
        'option_4s'    => 'required|string|max:255',
   
        ]);

        $question->update($data);
   

    $request->session()->flash('msg','question updated ');
    return redirect(url("dasboard/exams/show-questions/$exam->id"));

}
//
        public function delete(Exam $exam, Request $request )
        {
            try{
                $path = $exam->img;
        
                $exam->questions()->delete();
                $exam->delete();
                storage::delete($path);
        
                $msg = "Exam deleted";
                
            }catch(Exception $e){
        
                $msg = "Exam can't be deleted".$e->getMessage();
        
        
            }
        $request->session()->flash('msg-del',$msg);
            return back();
        }


        public function toggle(exam $exam)
{
     $exam->update([
         'active' => ! $exam->active,
     ]);
     return back();
}


}
