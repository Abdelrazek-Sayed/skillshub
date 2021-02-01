<?php

namespace App\Http\Controllers\admin;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
 
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    public function index()
    {
       $adminRole = Role::where('name','admin')->first();
       $superAdminRole = Role::where('name','superadmin')->first();


       $data['admins'] = User::whereIn('role_id',[$superAdminRole->id,$adminRole->id])
       ->orderBy('id','desc')
       ->paginate(10);
       
       return view("admin.admins.index")->with($data);
    }

    public function create()
        {

            $data['roles'] = Role::select('id','name')
            ->whereIn('name',['admin','superadmin'])
            ->get();

        return view('admin.admins.create')->with($data);
    }

    public function store(Request $request)
        {

         $request->validate([
             'name' => 'required|string|max:255',
             'email'=> 'required|email|max:255',
             'password'=> 'required|string|min:5|max:25|confirmed',
             'role_id'=> 'required|exists:roles,id',

             ]);

            $user = User::create([

                'name'     =>$request->name,
                'email'    =>$request->email,
                'password' => Hash::make($request->password),
                'role_id'    =>$request->role_id,
             ]);

             event(new Registered($user));

             return redirect(url("dashboard/admins"));
    }

    public function promote($id)
    {
        $admin = User::findOrFail($id);
        $admin->update([
            'role_id' => Role::select('id')->where('name','superadmin')->first()->id,
        ]);
        return back();
    }

    public function demote($id)
    {
        $superadmin = User::findOrFail($id);
        $superadmin->update([
            'role_id' => Role::select('id')->where('name','admin')->first()->id,
        ]);
        return back();
    }

}
