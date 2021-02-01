<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        // $SuperAdminRole = Role::where('name','superadmin')->first();

        // if(Auth::user()->role_id !== $SuperAdminRole){

            if(Auth::user()->role->name == 'superadmin'){
                return $next($request);
            }
            return redirect(url('/')) ;
    }
}
