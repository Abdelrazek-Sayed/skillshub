<?php

namespace App\Http\Controllers\admin;

use Exception;
use App\Models\Cat;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use function GuzzleHttp\Promise\exception_for;

class CatController extends Controller
{
    public function index()
    {

        $data['cats'] = Cat::orderBy('id','desc')->paginate(10);
        return view("admin.cats.index")->with($data);
    }

    public function store( Request $request)
    {
       // dd($request->all());


        $request->validate([
            'name_en' => 'required|string|min:3|max:30',
            'name_ar' => 'required|string|min:3|max:30',
        ]);

        Cat::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
        ]);
$request->session()->flash('msg',"Category created ");
        return back();
    }



    
    public function update(Request $request)
    {
       // dd($request->all());


        $request->validate([
            'id' => 'required|exists:cats,id',
            'name_en' => 'required|string|min:3|max:30',
            'name_ar' => 'required|string|min:3|max:30',
        ]);

        Cat::findOrFail($request->id)->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
        ]);
        $request->session()->flash('msg',"Category updated ");

        return back();
    }

    //public function delete($id)
    public function delete(Cat $cat ,Request $request)    //  route model binding
    { 
        // $cat = Cat::findOrFail($id)->delete();
        try{
            $cat->delete();
            $msg = "categoty deleted " ;
        }
        catch(Exception $e)
        {
            $msg ="categoty can't be deleted".$e->getMessage();
        }
    //   $deleltCat = 

     //  $msg = $deleltCat ? "categoty deleted " : "categoty can't be deleted ";
       $request->session()->flash('msg-del',$msg);
         return back();
        }



// toggle 

        public function toggle(Cat $cat)
        {
            $cat->update([
                'active' => ! $cat->active
            ]);

            return back();
        }
}
