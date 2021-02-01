<?php

namespace App\Http\Controllers\admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Mail\ContctResponseMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\contactController;

class MessegController extends Controller
{
     public function index()
     {
         $data['messeges'] = Message::orderBy('id','DESC')->paginate(5);
         
         return view("admin.messeges.index")->with($data);
     }
     public function show($id)
     {
          $data['messege'] = Message::findOrFail($id);

          return view('admin.messeges.show')->with($data);
     }

     public function response(Message $messege ,Request $request)
     {
          $request->validate([

            'title' => 'required|string|max:255',
            'body' => 'required|string|max:5000',
          ]);

          $name= $messege->name;
          $mail= $messege->email;

          // Mail::to('abdo@gmail.com')->
          Mail::to($mail)->
          send(new ContctResponseMail($name,$request->title,$request->body)
     
     );

     $request->session()->flash('msg',"sent well");
     return redirect(url("dashboard/messeges"));
     }
}
