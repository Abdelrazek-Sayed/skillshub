<?php

namespace App\Http\Controllers\admin;

use App\Models\Cat;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index()
    {
      $data['skills'] = Skill::orderBy('id','desc')->paginate(8);
      $data['cats'] = Cat::select('id','name')->get();
        return view('admin.skills.index')->with($data);
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $request->validate([
                'name_en' =>'required|string|max:50',
                'name_ar' =>'required|string|max:50',
                'img' =>'required|image|max:2048',
                'cat_id' =>'required|exists:cats,id',
        ]);

$path = Storage::putFile('skills',$request->file('img'));

        Skill::create([
            'name' => json_encode([
                'en' => $request->name_en,       
                'ar' => $request->name_ar,             
            ]),
            'img' => $path,
            'cat_id' => $request->cat_id,
            ]);


            $request->session()->flash('msg',"skill created ");
            return back();
        
    }

    public function update(Request $request)
    {
       // dd($request->all());


       $request->validate([
        'id' => 'required|exists:skills,id',
        'name_en' =>'required|string|max:50',
        'name_ar' =>'required|string|max:50',
        'img' =>'nullable|image|max:2048',
        'cat_id' =>'required|exists:cats,id',
                           ]);
$skill =  Skill::findOrFail($request->id);

$path = $skill->img;

if($request->hasFile('img')){

  storage::delete($path);
    $path = Storage::putFile('skills',$request->file('img'));
}

       $skill->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img'    => $path,
            'cat_id' => $request->cat_id,
        ]);
        $request->session()->flash('msg',"skill updated ");

        return back();
    }



public function delete(Skill $skill, Request $request )
{
    try{
        $path = $skill->img;

        $skill->delete();
        storage::delete($path);

        $msg = "Skill deleted";
        
    }catch(Exception $e){

        $msg = "Skill can't be deleted".$e->getMessage();


    }
$request->session()->flash('msg-del',$msg);
    return back();
}


public function toggle(skill $skill)
{
     $skill->update([
         'active' => ! $skill->active,
     ]);
     return back();
}

}
