<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class Skillcontroller extends Controller
{
    public function show($id){

$data['skills'] = Skill::findOrFail($id);

        return view("web.skills.show")->with($data);
        
    }
}
